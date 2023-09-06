<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\AccountService;
use App\Services\DepositIncludedService;
use App\Services\TimerService;

class AccountTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $accountService = app(AccountService::class,["i" => 0]);
        $depositIncludedService = app(DepositIncludedService::class,["id" => 0]);
        $timerService = new TimerService(30,$depositIncludedService);

        $accountIsCreated = $accountService->createAccount(0,2,1);
        $depositeIsCreated = $depositIncludedService->create(1,1,$timerService->getCurrentTime(),$timerService->getFutureTime(30));

        $state = $accountIsCreated && $depositeIsCreated;

        $this->assertTrue($state);
    }
}
