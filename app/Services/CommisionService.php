<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\AccountService;
use App\Services\TransferService;
use App\Services\InterestService;
use App\Services\TimerService;
use App\Services\DepositIncludedService;

class CommisionService
{
    public function __construct(private AccountService $accountService,private TransferService $transferService,private InterestService $interestService,private TimerService $timerService,private DepositIncludedService $depositIncludedService)
    {
        $this->accountService=$accountService;
        $this->transferService=$transferService;
        $this->interestService=$interestService;
        $this->timerService=$timerService;
        $this->depositIncludedService=$depositIncludedService;

    }

    private function getAmount(int $accountId): float
    {
        $interestId=(int)$this->accountService->getInterest($accountId);

        $interestValue=(float)$this->interestService->getInterest($interestId);

        $userBalance=$this->transferService->getBalance($accountId);

        return ($userBalance*$interestValue);
    }
    public function saveAmount(int $accountId): bool 
    {
        if(!$this->timerService->checkTime($accountId))
            return false;

        $amount=$this->getAmount($accountId);

        $start=$this->timerService->getCurrentTime(); //current timestamp

        $stop=$this->timerService->getFutureTime(30); //timestamp * countDay

        $dataIsSaved=$this->accountService->updateBalance($accountId,$amount) && $this->depositIncludedService->update($accountId,$start,$stop);

        if(!$dataIsSaved)
            return false;

        return true;
    }

}