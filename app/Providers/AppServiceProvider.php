<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->register();
        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addDays(1));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(10));
    }
}
