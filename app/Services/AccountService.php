<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Account;

class AccountService
{
    private int $id;

    public function __construct(private int $i)
    {
        $this->id=$i;

    }

    public function showAccounts(): string 
    {

        return "showAccounts";
    }

}