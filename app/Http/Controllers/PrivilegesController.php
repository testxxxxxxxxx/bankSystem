<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\IdRequest;
use App\Http\Requests\PrivilegesRequest;
use App\Services\PrivilegesService;
use Illuminate\Support\Facades\Auth;

class PrivilegesController extends Controller
{
    protected CONST ID=6;

    public function __construct(protected PrivilegesService $privilegesService)
    {
        $this->privilegesService=$privilegesService;
        
    }

    public function show(IdRequest $idRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,(int)Auth::id()))
        {
            $privileges=$this->privilegesService->getPrivileges((int)self::ID);

            return view('privileges',['privileges'=>$privileges]);
        }
        else
            return redirect()->back();

    }
    public function update(IdRequest $idRequest,PrivilegesRequest $privilegesRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,(int)Auth::id()))
        {
            $id=$idRequest->input('id');
            $controllerId=$privilegesRequest['controller_id'];
            $groupId=$privilegesRequest['group_id'];

            $privilegesIsUpdated=$this->privilegesService->updatePrivileges((int)$id,(int)$controllerId,(int)$groupId);

            if(!$privilegesIsUpdated)
                $message="Privileges has not been updated!";
            else
                $message="Privileges has been updated!";

            return redirect()->route('showPrivilege',[$privilegesIsUpdated,"id={$privilegesIsUpdated}"])->with('message',$message);

        }
        else
            return redirect()->back();

    }

}
