<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TransactionService;
use App\Services\TransferService;
use App\Services\PrivilegesService;
use App\Http\Requests\IdRequest;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    protected CONST ID=4;

    public function __construct(protected TransactionService $transactionService,protected TransferService $transferService,protected PrivilegesService $privilegesService)
    {
        $this->transactionService=$transactionService;
        $this->transferService=$transferService;
        $this->privilegesService=$privilegesService;

    }

    public function index()
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $transactions=$this->transactionService->getTransactions();

            return view('transactions',['transactions'=>$transactions]);
        }
        else
            return redirect()->back();

    }
    public function show(IdRequest $idRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
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
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $from=$transactionRequest->input('from');
            $to=$transactionRequest['to'];
            $amount=$transactionRequest['amount'];
            $date=$this->transferService->getCurrentDate();
            $time=$this->transferService->getCurrentTime();

            $createdTransaction=$this->transactionService->createTransaction((int)$from,(int)$to,(float)$amount,$date,$time);

            if($createdTransaction<0)
                $message="Transaction has not been created!";
            else
                $message="Transaction has been created!";

            return redirect()->route('showTransaction',[$createdTransaction])->with('message',$message);

        }
        else
            return redirect()->back();

    }
    public function update(IdRequest $idRequest,TransactionRequest $transactionRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $id=$idRequest->input('id');
            $from=$transactionRequest['from'];
            $to=$transactionRequest['to'];
            $amount=$transactionRequest['amount'];
            $date=$this->transferService->getCurrentDate();
            $time=$this->transferService->getCurrentTime();

            $updatedTransaction=$this->transactionService->updateTransaction((int)$id,(int)$from,(int)$to,(float)$amount,$date,$time);

            if(!$updatedTransaction)
                $message="Transaction has not been updated!";
            else
                $message="Transaction has been updated!";

            return redirect()->route('showTransaction',[$id])->with('message',$message);;

        }
        else
            return redirect()->back();

    }
    public function delete(IdRequest $idRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $id=$idRequest['id'];

            $deletedTransaction=$this->transactionService->deleteTransaction((int)$id);

            if(!$deletedTransaction)
                $message="Transaction has not been deleted!";
            else
                $message="Transaction has been deleted!";

            return redirect()->route('showTransactions',['message'=>$message]);

        }
        else
            return redirect()->back();
        
    }

}
