<?php

namespace App\Http\Controllers;

use App\Models\Privileges;
use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;
use App\Services\TransferService;
use App\Services\PrivilegesService;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    protected const ID=7;

    public function __construct(private TransferService $transferService,private PrivilegesService $privilegesService)
    {
        $this->transferService=$transferService;
        $this->privilegesService=$privilegesService;

    }

    public function __invoke(TransactionRequest $transactionRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,(int)Auth::id()))
        {
            $from=$transactionRequest->input('from');
            $to=$transactionRequest['to'];
            $amount=$transactionRequest['amount'];

            $amountIsMoved=$this->transferService->moveAmount((int)$from,(int)$to,(float)$amount);

            if(!$amountIsMoved)
                $message="Amount has not been moved!";
            else
                $message="Amount has been moved!";

            return redirect()->route('moveAmount',['message'=>$message]);
        }
        else
            return redirect()->back();
        
    }
    
}
