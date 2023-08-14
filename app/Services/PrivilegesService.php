<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\GroupService;
use App\Services\UserService;
use App\Models\Privileges;
use Illuminate\Database\Eloquent\Model;

class PrivilegesService
{
    public function __construct(protected GroupService $groupService,protected UserService $userService)
    {
        $this->groupService=$groupService;
        $this->userService=$userService;

    }

    public function getPrivileges(int $controllerId): int
    {
        $privileges=Privileges::query()->where('controller_id',$controllerId)->get('group_id')->toArray();

        return (int)$privileges[0]['group_id'];
    }
    public function createPrivileges(int $contorllerId,int $groupId): Model | null 
    {
        $privileges=Privileges::query()->create([

            "controller_id"=>$contorllerId,
            "group_id"=>$groupId,

        ]);

        return $privileges;
    }
    public function updatePrivileges(int $id,int $contorllerId,int $groupId): int | null 
    {
        $privileges=Privileges::query()->where('id',$id)->update(['controler_id'=>$contorllerId,'group_id'=>$groupId]);

        return $privileges;
    }
    public function checkPrivileges(int $controllerId,int $userId): bool 
    {
        $userGroupId=(int)$this->userService->getGroupId($userId);
        $controllerGroupId=(int)$this->getPrivileges($controllerId);

        if($userGroupId!==$controllerGroupId)
            return false;

        return true;
    }
    public function countOfGroupId(int $groupId): int 
    {
        $countOfGroup=Privileges::query()->where('group_id',$groupId)->get()->count();

        return $countOfGroup;
    }

}