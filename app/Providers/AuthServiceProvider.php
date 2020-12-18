<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\CompanyInformation;
use App\Models\Draft;
use App\Models\User;
use App\Policies\DraftPolicy;
use App\Policies\PostPolicy;
use App\Policies\CompanyPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        CompanyInformation::class => PostPolicy::class, // 投稿
        Company::class => CompanyPolicy::class, // 企業
        Draft::class => DraftPolicy::class // 下描き
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function (User $user) {
            return $user->privilege == 2;
        });
    }
}
