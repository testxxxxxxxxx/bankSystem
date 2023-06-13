<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TransactionService;
use App\Http\Requests\TranasctionRequest;

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

        }
        else
            return redirect()->back();

    }
    public function show()
    {

    }
    public function create()
    {

    }
    public function update()
    {

    }
    public function delete()
    {
        
    }

}
