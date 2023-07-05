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

    /*

        gets all informaction about user accounts

    */

    public function getAccounts(int $userId): Collection | null
    {
        $accounts=Account::query()->where('user_id',$userId)->get();

        return $accounts;
    }

    /*

        gets all information about account

    */

    public function getUserAccount(int $id): Collection | null 
    {
        $account=Account::query()->findOrFail($id)->get();

        return $account;

    }

    /*

        creates a new account

    */

    public function createAccount(float $balance=0,int $typeOfAccount,int $userId): int
    {
        $account=Account::query()->insertGetId([

            'balance'=>$balance,
            'typeOfAccount'=>$typeOfAccount,
            'user_id'=>$userId,

        ]);

        return $account;

    }

    /*

        updates informations in account

    */

    public function updateAccount(int $id,float $balance,int $typeOfAccount,int $userId): int
    {
        $account=Account::query()->where('id',$id)->update(['balance'=>$balance,'typeOfAccount'=>$typeOfAccount,'user_id'=>$userId]);

        return $account;
    }

    /*

        deletes account

    */

    public function deleteAccount(int $id): int 
    {
        $account=Account::query()->where('id',$id)->delete();

        return $account;
    }

    /*

        gets one information abount account

    */

    public function getUserInformation(int $id,string $column): array | null 
    {
        $account=Account::query()->where('id',$id)->get($column)->toArray();

        return $account;
    }

}