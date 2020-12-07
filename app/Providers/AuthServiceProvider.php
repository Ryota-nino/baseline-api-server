<?php

namespace App\Providers;

use App\Models\CompanyInformation;
use App\Policies\CompanyInformationPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
//        CompanyInformation::class => PostPolicy::class
        CompanyInformation::class => CompanyInformationPolicy::class
//        'App\Models\CompanyInformation' => 'App\Policies\CompanyInformationPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
