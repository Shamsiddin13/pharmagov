<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Sanctum\Sanctum;
use Carbon\CarbonInterval;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Reduce token last_used_at update frequency to once per minute
        Sanctum::authenticateAccessTokensUsing(function ($token, $isValid) {
            if (!$isValid) {
                return false;
            }

            $tokenLastUsed = $token->last_used_at;
            if ($tokenLastUsed && $tokenLastUsed->diffInSeconds(now()) < 60) {
                return true;
            }

            $token->forceFill(['last_used_at' => now()])->save();
            return true;
        });
    }
}