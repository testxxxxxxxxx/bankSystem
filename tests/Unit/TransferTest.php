<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Services\TransferService;
use App\Services\AccountService;
use App\Services\TransactionService;
use DateTime;

class TransferTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $transferService = new TransferService(new DateTime(),new AccountService(i: 0),new TransactionService());

        $state = $transferService->moveAmount(1,2,30);

        $this->assertTrue($state);
    }
}
