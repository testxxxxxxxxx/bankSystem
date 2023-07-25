<?php

declare(strict_types=1);

namespace App\Services;

class TimerService
{
    public function __construct(private int $countDay)
    {
        $this->countDay=$countDay;

    }

    public function measureTime(int $start,int $stop): int 
    {

        return ($stop - $start);
    }

}