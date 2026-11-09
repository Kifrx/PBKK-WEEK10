<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Proposal;
use App\Policies\ProposalPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Proposal::class, ProposalPolicy::class);

        // Gate global: Hanya dosen yang dapat memberi / menginput nilai proposal
        Gate::define('nilai-proposal', function (User $user) {
            return $user->role === 'dosen';
        });

        // Gate global: Akses area admin / review untuk dosen atau asisten dosen
        Gate::define('kelola-portal', function (User $user) {
            return in_array($user->role, ['dosen', 'asdos'], true);
        });
    }
}
