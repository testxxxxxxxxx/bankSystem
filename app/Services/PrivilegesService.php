<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\GroupService;
use App\Services\UserService;
use App\Services\ControllerService;
use App\Models\Privileges;
use Illuminate\Database\Eloquent\Model;

class PrivilegesService
{
    public function __construct(private GroupService $groupService,private UserService $userService,private ControllerService $controllerService)
    {
        $this->groupService = $groupService;
        $this->userService = $userService;
        $this->controllerService = $controllerService;

    }

    private function getPrivileges(int $controllerId): int
    {
        $privileges = Privileges::query()->where('controller_id',$controllerId)->get('group_id')->toArray();

        return (int)$privileges[0]['group_id'];
    }
    public function createPrivileges(int $contorllerId,int $groupId): Model | null 
    {
        $privileges = Privileges::query()->create([

            "controller_id"=>$contorllerId,
            "group_id"=>$groupId,

        ]);

        return $privileges;
    }
    public function updatePrivileges(int $id,int $contorllerId,int $groupId): int
    {
        $privileges = Privileges::query()->where('id',$id)->update(['controler_id'=>$contorllerId,'group_id'=>$groupId]);

        return $privileges;
    }
    public function checkPrivileges(int $controllerId,int $userId): bool 
    {
        $userGroupId = (int)$this->userService->getGroupId($userId);
        $controllerGroupId = (int)$this->getPrivileges($controllerId);

        if($userGroupId !== $controllerGroupId)
            return false;

        return true;
    }
    private function countOfGroupId(int $groupId): int 
    {
        $countOfGroup = Privileges::query()->where('group_id',$groupId)->get()->count();

        return $countOfGroup;
    }
    public function checkCountCorrect(int $groupId): bool 
    {
        $countIsCorrect = ($this->countOfGroupId($groupId) === $this->controllerService->countOfControllers()); //check correct count of controllers

        return $countIsCorrect?true:false;
    }

}