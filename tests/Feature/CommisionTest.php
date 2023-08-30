<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\CommisionService;
use App\Services\AccountService;
use App\Services\TransferService;
use App\Services\DepositIncludedService;
use App\Services\InterestService;
use App\Services\TimerService;
use App\Services\TransactionService;
use DateTime;

class CommisionTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $accountService = new AccountService(i: 0);
        $commisionService = new CommisionService((new AccountService(i: 0)),(new TransferService(app(DateTime::class),(new AccountService(i: 0)),app(TransactionService::class))),app(InterestService::class),app(TimerService::class),(new DepositIncludedService(id: 0)));

        for($i = 0; $i < $accountService->getNumberOfRecords(); $i++)
        {
            $state = $commisionService->saveAmount($i);

            $this->assertTrue($state);
        }

    }
}
