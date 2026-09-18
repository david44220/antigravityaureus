<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Actions\DepositFundsAction;
use App\Actions\PurchasePackAction;
use App\Models\AdPackTier;
use App\Models\CyclerQueue;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class CyclerEngineTest extends TestCase
{
    use RefreshDatabase;

    protected AdPackTier $tier1;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tier1 = AdPackTier::create([
            'name' => 'Aurum Tier I',
            'slug' => 'tier-1',
            'price' => 10.00,
            'ad_credits_awarded' => 1000,
            'required_downstream' => 2,
            'payout_amount' => 15.00,
            'auto_reentry' => false,
            'is_active' => true,
            'sort_order' => 1,
        ]);
    }

    /**
     * Test that user registration automatically provisions a 1-to-1 wallet.
     */
    public function test_user_wallet_is_automatically_provisioned(): void
    {
        $user = User::factory()->create();

        $this->assertNotNull($user->wallet);
        $this->assertEquals('0.00', (string) $user->wallet->purchase_balance);
        $this->assertEquals('0.00', (string) $user->wallet->earnings_balance);
        $this->assertEquals(0, $user->wallet->ad_credits);
    }

    /**
     * Test deposit action credits balance and writes double-entry ledger.
     */
    public function test_deposit_action_credits_purchase_balance_and_records_transaction(): void
    {
        $user = User::factory()->create();
        $depositAction = app(DepositFundsAction::class);

        $wallet = $depositAction->execute($user, 100.00);

        $this->assertEquals('100.00', (string) $wallet->purchase_balance);

        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'wallet_id' => $wallet->id,
            'type' => 'DEPOSIT',
            'wallet_type' => 'PURCHASE',
            'amount' => '100.00',
            'balance_after' => '100.00',
        ]);
    }

    /**
     * Test purchase pack throws exception when balance is insufficient.
     */
    public function test_purchase_pack_fails_with_insufficient_balance(): void
    {
        $user = User::factory()->create();
        $purchaseAction = app(PurchasePackAction::class);

        $this->expectException(ValidationException::class);

        $purchaseAction->execute($user, $this->tier1->id);
    }

    /**
     * Test purchasing a pack deducts balance, awards credits, and enqueues position.
     */
    public function test_purchase_pack_deducts_balance_awards_credits_and_enqueues_position(): void
    {
        $user = User::factory()->create();
        app(DepositFundsAction::class)->execute($user, 50.00);
        $purchaseAction = app(PurchasePackAction::class);

        $purchase = $purchaseAction->execute($user, $this->tier1->id);

        $user->wallet->refresh();

        $this->assertEquals('40.00', (string) $user->wallet->purchase_balance);
        $this->assertEquals(1000, $user->wallet->ad_credits);

        $this->assertDatabaseHas('cycler_queues', [
            'user_id' => $user->id,
            'ad_pack_tier_id' => $this->tier1->id,
            'purchase_id' => $purchase->id,
            'status' => 'QUEUED',
            'downstream_count' => 0,
        ]);

        $this->assertDatabaseHas('transactions', [
            'user_id' => $user->id,
            'type' => 'PACK_PURCHASE',
            'amount' => '-10.00',
        ]);
    }

    /**
     * Test complete FIFO cycler resolution: when 2 downstream positions join, head position cycles and pays out ROI.
     */
    public function test_fifo_cycler_resolves_and_pays_roi_upon_downstream_accumulation(): void
    {
        $userA = User::factory()->create();
        $userB = User::factory()->create();
        $userC = User::factory()->create();

        $depositAction = app(DepositFundsAction::class);
        $depositAction->execute($userA, 50.00);
        $depositAction->execute($userB, 50.00);
        $depositAction->execute($userC, 50.00);

        $purchaseAction = app(PurchasePackAction::class);

        // 1. User A purchases Tier 1 (Enters head of queue)
        $purchaseAction->execute($userA, $this->tier1->id);

        $posA = CyclerQueue::where('user_id', $userA->id)->firstOrFail();
        $this->assertEquals('QUEUED', $posA->status);
        $this->assertEquals(0, $posA->downstream_count);

        // 2. User B purchases Tier 1 (First downstream position)
        $purchaseAction->execute($userB, $this->tier1->id);

        $posA->refresh();
        $this->assertEquals('QUEUED', $posA->status);
        $this->assertEquals(1, $posA->downstream_count);

        // 3. User C purchases Tier 1 (Second downstream position -> triggers cycle!)
        $purchaseAction->execute($userC, $this->tier1->id);

        $posA->refresh();
        $this->assertEquals('COMPLETED', $posA->status);
        $this->assertEquals('15.00', (string) $posA->payout_amount);
        $this->assertNotNull($posA->cycled_at);

        // Verify User A received 150% ROI directly to earnings balance
        $userA->wallet->refresh();
        $this->assertEquals('15.00', (string) $userA->wallet->earnings_balance);

        // Verify payout transaction recorded in ledger
        $this->assertDatabaseHas('transactions', [
            'user_id' => $userA->id,
            'type' => 'CYCLER_PAYOUT',
            'wallet_type' => 'EARNINGS',
            'amount' => '15.00',
            'balance_after' => '15.00',
            'reference_type' => CyclerQueue::class,
            'reference_id' => $posA->id,
        ]);
    }
}
