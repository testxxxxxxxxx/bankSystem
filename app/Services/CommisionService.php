<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\TransferService;
use App\Services\InterestService;
use App\Services\TimerService;

class CommisionService
{
    public function __construct(private TransferService $transferService,private InterestService $interestService,private TimerService $timerService)
    {
        $this->transferService=$transferService;
        $this->interestService=$interestService;

    }

    private function getAmount(int $accountId,int $interestId): float
    {
        $interestValue=$this->interestService->getInterest($interestId);
        $userBalance=$this->transferService->getBalance($accountId);

        return ($userBalance*$interestValue);
    }

}