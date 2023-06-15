<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TransactionService;
use App\Http\Requests\IdRequest;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{

    public function __construct(protected TransactionService $transactionService)
    {
        $this->transactionService=$transactionService;

    }

    public function index()
    {
        if(Auth::check())
        {
            $transactions=$this->transactionService->getTransactions();

            return view('transactions',['transactions'=>$transactions]);
        }
        else
            return redirect()->back();

    }
    public function show(IdRequest $idRequest)
    {
        if(Auth::check())
        {
            $id=$idRequest->input('id');

            $transaction=$this->transactionService->getTransaction((int)$id);

            return view('transactions',['transaction'=>$transaction]);
        }
        else
            return redirect()->back();

    }
    public function create(TransactionRequest $transactionRequest)
    {
        if(Auth::check())
        {
            $from=$transactionRequest->input('from');
            $to=$transactionRequest['to'];
            $amount=$transactionRequest['amount'];
            $date=$transactionRequest['date'];
            $time=$transactionRequest['time'];
            $id=1;

            $createdTransaction=$this->transactionService->createTransaction((int)$from,(int)$to,(float)$amount,$date,$time);

            if($createdTransaction<0)
                $message="Transaction has not been created!";
            else
                $message="Transaction has been created!";

            return redirect()->route('showTransaction',['id'=>$createdTransaction,'message'=>$message]);

        }
        else
            return redirect()->back();

    }
    public function update()
    {

    }
    public function delete()
    {
        
    }

}
