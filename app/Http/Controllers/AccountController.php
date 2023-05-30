<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AccountService;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    protected object $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService=$accountService;

    }

    public function index()
    {
        if(Auth::check())
        {
            $res=$this->accountService->showAccounts();

            return $res;

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
