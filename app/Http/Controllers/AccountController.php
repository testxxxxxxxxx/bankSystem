<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AccountService;

class AccountController extends Controller
{
    protected object $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService=$accountService;

    }

    public function index()
    {
        $res=$this->accountService->showAccounts();

        return $res;

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
