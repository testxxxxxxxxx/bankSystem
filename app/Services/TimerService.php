<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\DepositIncludedService;

class TimerService
{
    public function __construct(private int $countDay,private DepositIncludedService $depositIncludedService)
    {
        $this->countDay=$countDay;
        $this->depositIncludedService=$depositIncludedService;

    }

    // measure a time

    private function measureTime(int $start,int $stop): int 
    {

        return ($stop - $start);
    }

    // check if time is equal countDay value

    public function checkTime(int $id): bool 
    {
        $start=(int)$this->depositIncludedService->getStart($id);
        $stop=(int)$this->depositIncludedService->getStop($id);

        $timeIsUp=$this->measureTime($start,$stop);

        if($timeIsUp!==$this->countDay)
            return false;

        return true;
    }

    //gets current timestamp

    public function getCurrentTime(): int 
    {

        return time();
    }

    //gets timestamp * countDay

    public function getFutureTime(int $countDay): int 
    {

        return time()+(3600*24)*$countDay;
    }

}