<?php

declare(strict_types=1);

namespace App\Services;

use App\Services\GroupService;
use App\Services\UserService;
use App\Models\Controller;
use App\Models\Privileges;

class PrivilegesService
{
    public function __construct(protected GroupService $groupService,protected UserService $userService)
    {
        $this->groupService=$groupService;
        $this->userService=$userService;

    }

    private function getPrivileges(int $controllerId): array | null 
    {
        $privileges=Privileges::query()->where('controller_id',$controllerId)->get('group_id')->toArray();

        return $privileges[0]['group_id'];
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

}