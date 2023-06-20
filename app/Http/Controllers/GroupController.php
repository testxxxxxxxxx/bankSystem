<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\IdRequest;
use App\Http\Requests\GroupRequest;
use App\Services\GroupService;
use App\Services\PrivilegesService;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    protected CONST ID=5;

    public function __construct(protected GroupService $groupService,protected PrivilegesService $privilegesService)
    {
        $this->groupService=$groupService;
        $this->privilegesService=$privilegesService;

    }

    public function index()
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,(int)Auth::id()))
        {
            $groups=$this->groupService->getGroups();

            return view('groups',['groups'=>$groups]);
        }
        else
            return redirect()->back();

    }
    public function show(IdRequest $idRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,(int)Auth::id()))
        {
            $id=$idRequest->input('id');

            $name=$this->groupService->getName((int)$id);

            return view('groups',['name'=>$name]);
        }
        else
            return redirect()->back();

    }
    public function create(GroupRequest $groupRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,(int)Auth::id()))
        {
            $name=$groupRequest['name'];

            $groupIsCreated=$this->groupService->createGroup($name);

            if(!$groupIsCreated)
                $message="Group has not been created!";
            else
                $message="Group has been created!";

            return redirect()->route('showGroup',[$groupIsCreated])->with('message',$message);
        }
        else
            return redirect()->back();

    }
    public function update(IdRequest $idRequest,GroupRequest $groupRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,(int)Auth::id()))
        {
            $id=$idRequest->input('id');
            $name=$groupRequest['name'];

            $groupIsUpdated=$this->groupService->updateGroup((int)$id,$name);

            if(!$groupIsUpdated)
                $message="Group has not been updated!";
            else
                $message="Group has been updated!";

            return redirect()->route('showGroup',[$groupIsUpdated])->with('message',$message);
        }
        else
            return redirect()->back();

    }
    public function delete(IdRequest $idRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,(int)Auth::id()))
        {
            $id=$idRequest['id'];

            $groupIsDeleted=$this->groupService->deleteGroup((int)$id);

            if(!$groupIsDeleted)
                $message="Group has not been deleted!";
            else
                $message="Group has been deleted!";

            return redirect()->route('showGroups',['message'=>$message]);
        }

    }

}
