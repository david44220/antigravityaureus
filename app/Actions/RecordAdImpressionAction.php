<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Advertisement;
use Illuminate\Support\Facades\DB;

class RecordAdImpressionAction
{
    /**
     * Atomically debit one advertising credit and increment impression counter.
     */
    public function execute(Advertisement $advertisement): void
    {
        DB::transaction(function () use ($advertisement): void {
            /** @var Advertisement|null $lockedAd */
            $lockedAd = Advertisement::where('id', $advertisement->id)
                ->lockForUpdate()
                ->first();

            if (! $lockedAd || $lockedAd->status !== 'ACTIVE' || $lockedAd->credits_allocated <= 0) {
                return;
            }

            $lockedAd->credits_allocated -= 1;
            $lockedAd->impressions += 1;

            if ($lockedAd->credits_allocated === 0) {
                $lockedAd->status = 'DEPLETED';
            }

            $lockedAd->save();
        });
    }
}
