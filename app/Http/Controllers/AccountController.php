<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Http\Requests\IdRequest;
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
            $userId=Auth::id();

            $res=$this->accountService->getAccounts($userId);

            return view('accounts',['res'=>$res]);

        }
        else
            return redirect()->back();

    }
    public function show(IdRequest $idRequest)
    {
        if(Auth::check())
        {
            $id=$idRequest['id'];

            $res=$this->accountService->getUserAccount((int)$id);

            return view('accounts',['res'=>$res]);

        }
        else
            return redirect()->back();

    }
    public function create(AccountRequest $accountRequest)
    {
        if(Auth::check())
        {
            $balance=$accountRequest['balance'];
            $typeOfAccount=$accountRequest['typeOfAccount'];
            $userId=Auth::id();

            $accountIsCreated=$this->accountService->createAccount($balance,$typeOfAccount,$userId);

            if(!$accountIsCreated)
                $res="Your account has not been created!";
            else
                $res="Your account has been created!"; 

            return redirect()->route('showUserAccount',['res'=>$res]);

        }
        else
            return redirect()->back();

    }
    public function update(IdRequest $idRequest,AccountRequest $accountRequest)
    {
        if(Auth::check())
        {
            $id=$idRequest->input('id');
            $balance=$accountRequest['balance'];
            $typeOfAccount=$accountRequest['typeOfAccount'];
            $userId=Auth::id();

            $accountIsUpdated=$this->accountService->updateAccount($id,$balance,$typeOfAccount,$userId);

            if(!$accountIsUpdated)
                $res="Your account has not been updated!";
            else
                $res="Your account has not been updated!";

            return redirect()->route('showUserAccount',['res'=>$res]);

        }
        else
            return redirect()->back();

    }
    public function delete(IdRequest $idRequest)
    {
        if(Auth::check())
        {
            $id=$idRequest->input('id');

            $accountIsDeleted=$this->accountService->deleteAccount($id);

            if(!$accountIsDeleted)
                $res="Your account has not been deleted!";
            else
                $res="Your account has been deleted!";

            return redirect()->route('showUserAccount',['res'=>$res]);

        }
        else
            return redirect()->back();

    }
    
}
