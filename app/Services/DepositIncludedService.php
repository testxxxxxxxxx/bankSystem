<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\DepositIncluded;
use Illuminate\Database\Eloquent\Model;

class DepositIncludedService
{
    public function __construct(private int $id)
    {
        $this->id=$id;

    }

    public function getInterestId(int $id): array | null 
    {
        $interestId=DepositIncluded::query()->find($id)->get('interest_id')->toArray();

        return $interestId[0]['interest_id'];
    }
    public function getAccountId(int $id): array | null 
    {
        $accountId=DepositIncluded::query()->find($id)->get('account_id')->toArray();

        return $accountId[0]['account_id'];
    }
    public function getStart(int $id): float
    {
        $start=DepositIncluded::query()->find($id)->get('start')->toArray();

        return $start[0]['start'];
    }
    public function getStop(int $id): float 
    {
        $stop=DepositIncluded::query()->find($id)->get('stop')->toArray();

        return $stop[0]['stop'];
    }
    public function create(int $interestId,int $accountId,int $start,int $stop): Model | null 
    {
        $deposit=DepositIncluded::query()->insertGetId([

            'interest_id'=>$interestId,
            'account_id'=>$accountId,
            'start'=>$start,
            'stop'=>$stop,

        ]);

        return $deposit;
    }
    public function update(int $accountId,int $start,int $stop): int 
    {
        $deposit=DepositIncluded::query()->where('account_id',$accountId)->update(['start'=>$start,'stop'=>$stop]);

        return $deposit;
    }
    public function delete(int $id): int 
    {
        $deposit=DepositIncluded::query()->where('id',$id)->delete();

        return $deposit;
    }

}