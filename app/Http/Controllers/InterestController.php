<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdRequest;
use App\Http\Requests\InterestRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\InterestService;
use App\Services\PrivilegesService;

class InterestController extends Controller
{
    protected CONST ID=3;

    public function __construct(protected InterestService $interestService,protected PrivilegesService $privilegesService)
    {
        $this->interestService=$interestService;
        $this->privilegesService=$privilegesService;

    }

    public function index()
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $intrests=$this->interestService->getAllInterests();

            return view('interests',['interests'=>$intrests]);
        }
        else
            return redirect()->back();

    }
    public function show(IdRequest $idRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $id=$idRequest->input('id');

            $interest=$this->interestService->getInterest((int)$id);

            return view('interests',['interest'=>$interest]);
        }
        else
            return redirect()->back();

    }
    public function create(InterestRequest $interestRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $value=$interestRequest['value'];

            $createdInterest=$this->interestService->createInterest((float)$value);

            if($createdInterest<0)
                $message="Interest has not been created!";
            else
                $message="Interest has been created!";

            return redirect()->route('showInterest',[$createdInterest,"id={$createdInterest}"])->with('message',$message);
        }
        else
            return redirect()->back();

    }
    public function update(IdRequest $idRequest,InterestRequest $interestRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $id=$idRequest->input('id');
            $value=$interestRequest['value'];

            $updatedInterest=$this->interestService->updateInterest((int)$id,(float)$value);

            if(!$updatedInterest)
                $message="Interest has not been updated!";
            else
                $message="Interest has been updated!";

            return redirect()->route('showInterest',[$updatedInterest,"id={$updatedInterest}"])->with('message',$message);
        }
        else
            return redirect()->back();

    }
    public function delete(IdRequest $idRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $id=$idRequest['id'];

            $deletedInterest=$this->interestService->deleteInterest((int)$id);

            if(!$deletedInterest)
                $message="Interest has not been deleted!";
            else
                $message="Interest has been deleted!";

            return redirect()->route('showInterests',['message'=>$message]);
        }
        else
            return redirect()->back();

    }

}
