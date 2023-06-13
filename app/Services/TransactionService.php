<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TransactionService
{
    private int $id;

    public function __construct(private int $i=0)
    {
        $this->id=$i;

    }

    public function getTransfers(): Collection | null
    {
        $transactions=Transaction::query()->get();

        return $transactions;
    }
    public function createTransfer(int $from,int $to,float $amount,string $date,string $time): Model | null 
    {
        $transaction=Transaction::query()->create([

            'from'=>$from,
            'to'=>$to,
            'amount'=>$amount,
            'date'=>$date,
            'time'=>$time,

        ]);

        return $transaction;
    }
    public function updateTransaction(int $id,int $from,int $to,float $amount,string $data,string $time): int 
    {
        $transaction=Transaction::query()->where('id',$id)->update(['id'=>$id,'from'=>$from,'to'=>$to,'amount'=>$amount,'data'=>$data,'time'=>$time]);

        return $transaction;
    }
    public function deleteTransaction(int $id): int 
    {
        $transaction=Transaction::query()->where('id',$id)->delete();

        return $transaction;
    }

}