<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\AccountService;
use App\Services\DepositIncludedService;
use App\Services\TimerService;
use \DateTime;

class AccountTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $accountService = app(AccountService::class, ["i" => 0]);
        $depositIncludedService = app(DepositIncludedService::class, ["id" => 0]);
        $timerService = app(TimerService::class, ["countDay" => 30, $depositIncludedService, app(DateTime::class)]);

        $accountIsCreated = $accountService->createAccount(0, 2, 1);
        $depositeIsCreated = $depositIncludedService->create(1, 2, $timerService->convertTime($timerService->getCurrentTime(), 'Y-m-d H:i:s'), $timerService->convertTime($timerService->getFutureTime($timerService->countDay), 'Y-m-d H:i:s'));

        $state = $accountIsCreated && $depositeIsCreated;

        $this->assertTrue($state);
    }
}
