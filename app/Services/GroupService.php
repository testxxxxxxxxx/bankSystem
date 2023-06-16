<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Group;
use Illuminate\Database\Eloquent\Collection;

class GroupService
{
    private int $id;

    public function __construct(private int $i=0)
    {
        $this->id=$i;

    }

    public function getGroups(): Collection | null 
    {
        $groups=Group::query()->get();

        return $groups;
    }
    public function getName(int $id): Collection | null 
    {
        $name=Group::query()->where('id',$id)->get('name');

        return $name;
    }
    public function createGroup(string $name): int | null  
    {
        $group=Group::query()->insertGetId([

            'name'=>$name,

        ]);

        return $group;

    }
    public function updateGroup(int $id,string $name): int | null 
    {
        $group=Group::query()->where('id',$id)->update(['id'=>$id,'name'=>$name]);

        return $group;
    }
    public function deleteGroup(int $id): int | null 
    {
        $group=Group::query()->where('id',$id)->delete();

        return $group;
    }

}