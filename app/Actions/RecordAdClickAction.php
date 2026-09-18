<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Advertisement;
use App\Models\AdvertisementClick;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RecordAdClickAction
{
    /**
     * Atomically record an advertisement click telemetry log and increment click counter.
     */
    public function execute(Advertisement $advertisement, ?User $user, string $ipAddress, ?string $userAgent): string
    {
        return DB::transaction(function () use ($advertisement, $user, $ipAddress, $userAgent): string {
            /** @var Advertisement $lockedAd */
            $lockedAd = Advertisement::where('id', $advertisement->id)
                ->lockForUpdate()
                ->firstOrFail();

            $lockedAd->clicks += 1;
            $lockedAd->save();

            AdvertisementClick::create([
                'advertisement_id' => $lockedAd->id,
                'user_id' => $user?->id,
                'ip_address' => mb_substr($ipAddress, 0, 45),
                'user_agent' => $userAgent ? mb_substr($userAgent, 0, 1000) : null,
                'created_at' => now(),
            ]);

            return $lockedAd->target_url;
        });
    }
}
