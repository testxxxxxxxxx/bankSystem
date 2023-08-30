<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Http\Requests\IdRequest;
use Illuminate\Http\Request;
use App\Services\AccountService;
use App\Services\PrivilegesService;
use App\Services\TypesOfAccountService;
use App\Services\DepositIncludedService;
use App\Services\TimerService;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public CONST ID=1;

    public function __construct(protected AccountService $accountService,protected PrivilegesService $privilegesService,protected TypesOfAccountService $typesOfAccountService,private DepositIncludedService $depositIncludedService,private TimerService $timerService)
    {
        $this->accountService=$accountService;
        $this->privilegesService=$privilegesService;
        $this->typesOfAccountService=$typesOfAccountService;
        $this->depositIncludedService=$depositIncludedService;
        $this->timerService=$timerService;

    }

    public function index()
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $userId=Auth::id();

            $accounts=$this->accountService->getAccounts($userId);
            $typesOfAccounts=$this->typesOfAccountService->getTypesOfAccount();

            return view('accounts',['accounts'=>$accounts,'typesOfAccounts'=>$typesOfAccounts]);
        }
        else
            return redirect()->back();

    }
    public function show(IdRequest $idRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $id=$idRequest['id'];

            $account=$this->accountService->getUserAccount((int)$id);

            return view('accounts',['account'=>$account]);
        }
        else
            return redirect()->back();

    }
    public function create(AccountRequest $accountRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $typeOfAccount=(int)$accountRequest['typeOfAccount'];
            $userId=Auth::id();

            $accountIsCreated=$this->accountService->createAccount(0,(int)$typeOfAccount,(int)$userId);
            $interestId=$this->accountService->getInterest($accountIsCreated);
            $depositIsCreated=$this->depositIncludedService->create($interestId,$accountIsCreated,$this->timerService->getCurrentTime(),$this->timerService->getFutureTime($this->timerService->countDay));

            if($accountIsCreated<1 && $depositIsCreated)
                $message="Your account has not been created!";
            else
                $message="Your account has been created!"; 

            return redirect()->route('showUserAccount',[$accountIsCreated,"id=$accountIsCreated"])->with('message',$message);
        }
        else
            return redirect()->back();

    }
    public function update(IdRequest $idRequest,AccountRequest $accountRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $id=$idRequest->input('id');
            $balance=$accountRequest['balance'];
            $typeOfAccount=$accountRequest['typeOfAccount'];
            $userId=Auth::id();

            $accountIsUpdated=$this->accountService->updateAccount($id,$balance,$typeOfAccount,$userId);

            if(!$accountIsUpdated)
                $message="Your account has not been updated!";
            else
                $message="Your account has not been updated!";

            return redirect()->route('showUserAccount',[$accountIsUpdated,"id={$accountIsUpdated}"])->with('message',$message);
        }
        else
            return redirect()->back();

    }
    public function delete(IdRequest $idRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $id=$idRequest->input('id');

            $accountIsDeleted=$this->accountService->deleteAccount($id);

            if(!$accountIsDeleted)
                $message="Your account has not been deleted!";
            else
                $message="Your account has been deleted!";

            return redirect()->route('showAccounts')->with('message',$message);
        }
        else
            return redirect()->back();

    }
    
}
