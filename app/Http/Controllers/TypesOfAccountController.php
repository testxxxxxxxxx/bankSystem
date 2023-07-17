<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TypesOfAccountService;
use App\Services\PrivilegesService;
use App\Http\Requests\TypesOfAccountRequest;

class TypesOfAccountController extends Controller
{
    protected CONST ID=2;
    
    public function __construct(protected TypesOfAccountService $typesOfAccountService,protected PrivilegesService $privilegesService)
    {
        $this->typesOfAccountService=$typesOfAccountService;
        $this->privilegesService=$privilegesService;

    }

    public function index()
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $typesOfAccount=$this->typesOfAccountService->getTypesOfAccount();

            return view('typesOfAccount',['typesOfAccount'=>$typesOfAccount]);
        }
        else
            redirect()->back();

    }
    public function show(IdRequest $idRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $id=$idRequest->input('id');

            $name=$this->typesOfAccountService->getName($id);
            $interestId=$this->typesOfAccountService->getIntrestId($id);

            return view('typesOfAccount',['name'=>$name,'interestId'=>$interestId]);
        }
        else
            return redirect()->back();

    }
    public function create(TypesOfAccountRequest $typesOfAccountRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $name=$typesOfAccountRequest->input('name');
            $interestId=$typesOfAccountRequest['interestId'];

            $createdTypesOfAccount=$this->typesOfAccountService->createTypesOfAccount($name,(int)$interestId);

            if($createdTypesOfAccount<0)
                $message="Type of account has not been created!";
            else
                $message="Type of account has been created!";

            return redirect()->route('showTypesOfAccount',[$createdTypesOfAccount,"id={$createdTypesOfAccount}"])->with('message',$message);

        }
        else
            return redirect()->back();

    }
    public function update(IdRequest $idRequest,TypesOfAccountRequest $typesOfAccountRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $id=$idRequest->input('id');
            $name=$typesOfAccountRequest['name'];
            $interestId=$typesOfAccountRequest['interestId'];

            $updatedTypeOfAccount=$this->typesOfAccountService->updateTypesOfAccount((int)$id,$name,(int)$interestId);

            if(!$updatedTypeOfAccount)
                $message="Type of account has not been updated!";
            else
                $message="Type of account has been updated!";

            return redirect()->route('showTypesOfAccount',[$updatedTypeOfAccount,"id={$updatedTypeOfAccount}"])->with('message',$message);

        }
        else
            return redirect()->back();

    }
    public function delete(IdRequest $idRequest)
    {
        if(Auth::check() && $this->privilegesService->checkPrivileges((int)self::ID,Auth::id()))
        {
            $id=$idRequest['id'];

            $deletedTypeOfAccount=$this->typesOfAccountService->deleteTypesOfAccount((int)$id);

            if(!$deletedTypeOfAccount)
                $message="Type of account has not been deleted!";
            else
                $message="Type of account has been deleted!";

                return redirect()->route('showTypesOfAccount',['message'=>$message]);

        }
        else
            return redirect()->back();

    }

}
