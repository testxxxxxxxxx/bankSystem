<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Account;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

class AccountService
{
    private int $id;

    public function __construct(private int $i)
    {
        $this->id=$i;

    }

    public function showAccounts(): Collection | null
    {
        $accounts=Account::query()->get();

        return $accounts;
    }
    public function showUserAccount(int $id): Collection | null 
    {
        $account=Account::query()->findOrFail($id)->get();

        return $account;

    }
    public function createAccount(float $balance,int $typeOfAccount,int $userId): Model | null 
    {
        $account=Account::query()->create([

            'balance'=>$balance,
            'typeOfAccount'=>$typeOfAccount,
            'user_id'=>$userId,

        ]);

        return $account;

    }
    public function updateAccount(int $id,float $balance,int $typeOfAccount,int $userId): int
    {
        $account=Account::query()->where('id',$id)->update(['balance'=>$balance,'typeOfAccount'=>$typeOfAccount,'user_id'=>$userId]);

        return $account;
    }
    public function deleteAccount(int $id): int 
    {
        $account=Account::query()->where('id',$id)->delete();

        return $account;
    }
    public function getUserInformation(int $id,string $column): Collection | null 
    {
        $account=Account::query()->find($id)->get($column);

        return $account;

    }

}