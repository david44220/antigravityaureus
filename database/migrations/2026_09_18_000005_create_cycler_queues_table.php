<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cycler_queues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('ad_pack_tier_id')->constrained()->cascadeOnDelete();
            $table->foreignId('purchase_id')->nullable()->constrained('ad_pack_purchases')->nullOnDelete();
            $table->string('status', 24)->default('QUEUED');
            $table->unsignedSmallInteger('downstream_count')->default(0);
            $table->decimal('payout_amount', 12, 2)->nullable();
            $table->boolean('is_reentry')->default(false);
            $table->timestamp('cycled_at')->nullable();
            $table->timestamps();

            $table->index(['ad_pack_tier_id', 'status', 'id'], 'idx_cycler_fifo');
            $table->index(['user_id', 'status'], 'idx_user_cycler_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cycler_queues');
    }
};
