<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;

class UserService 
{
    protected int $id;

    public function __construct(private int $i=0)
    {
        $this->id=$i;
        
    }

    public function getGroupId(int $id): array | null 
    {
        $groupId=User::query()->where('id',$id)->get('group_id')->toArray();

        return $groupId[0]['group_id'];
    }

}