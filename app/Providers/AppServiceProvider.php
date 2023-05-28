<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Services\AccountService;
use App\Services\TransferService;
use App\Services\TransactionService;
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

            return new TransferService((new DateTime()),(new AccountService(i: 0)),(new TransactionService(i: 0)));
        });
        $this->app->bind(TransactionService::class,function($app){

            return new TransactionService(i: 0);
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
