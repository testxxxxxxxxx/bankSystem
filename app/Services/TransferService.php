<?php

declare(strict_types=1);

namespace App\Services;

use DateTime;
use App\Services\AccountService;
use App\Services\TransactionService;
use Illuminate\Database\Eloquent\Model;

class TransferService
{
    public function __construct(private DateTime $dateTime,private AccountService $accountService,private TransactionService $transactionService)
    {
        $this->dateTime=$dateTime;
        $this->accountService=$accountService;
        $this->transactionService=$transactionService;
        
    }

    /*
        moves amount from account to another account  

    */

    public function moveAmount(int $from,int $to,float $amount): bool 
    {
        $balanceFrom=$this->getBalance($from)-$amount;
        $balanceTo=$this->getBalance($to)+$amount;
        $date=$this->getCurrentDate();
        $time=$this->getCurrentTime();

        if($balanceFrom<0)
            return false;
        else if($this->saveCurrentBalance($from,$balanceFrom) && $this->saveCurrentBalance($to,$balanceTo) && $this->transactionService->createTransaction($from,$to,$amount,$date,$time))
        {

            return true;
        }

    }

    /*

        gets current date

    */

    public function getCurrentDate(): string
    {

        return $this->dateTime->format("d");
    }

    /*

        gets current time

    */

    public function getCurrentTime(): string
    {

        return $this->dateTime->format("H:i:S");
    }

    /*

        gets balance from one account

    */

    public function getBalance(int $id): float
    {

        return (float)$this->accountService->getUserInformation($id,'balance')[0]['balance'];
    }

    /*

        saves current balance for account

    */

    public function saveCurrentBalance(int $id,float $balance): int 
    {
        $typeOfAccount=(int)$this->accountService->getUserInformation($id,'typeOfAccount');
        $userId=(int)$this->accountService->getUserInformation($id,'user_id');

        return $this->accountService->updateAccount($id,$balance,$typeOfAccount,$userId);
    }

}