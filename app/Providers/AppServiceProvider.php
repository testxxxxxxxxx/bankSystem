<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Services\AccountService;
use App\Services\TransferService;
use App\Services\TransactionService;
use App\Services\TypesOfAccountService;
use App\Services\InterestService;
use App\Services\GroupService;
use App\Services\PrivilegesService;
use App\Services\UserService;
use DateTime;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AccountService::class,function($app){

            return new AccountService(i: 0);
        });
        $this->app->bind(TransferService::class,function($app){

            return new TransferService($app->make(DateTime::class),$app->make(AccountService::class),$app->make(TransactionService::class));
        });
        $this->app->bind(TransactionService::class,function($app){

            return new TransactionService(i: 0);
        });
        $this->app->bind(TypesOfAccountService::class,function($app){

            return new TypesOfAccountService(i: 0);
        });
        $this->app->bind(InterestService::class,function($app){

            return new InterestService(i: 0);
        });
        $this->app->bind(GroupService::class,function($app){

            return new GroupService(i: 0);
        });
        $this->app->bind(PrivilegesService::class,function($app){

            return new PrivilegesService($app->make(GroupService::class),$app->make(UserService::class));
        });
        $this->app->bind(UserService::class,function($app){

            return new UserService(i: 0);
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(255);

    }
}
