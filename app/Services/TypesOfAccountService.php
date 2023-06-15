<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\TypesOfAccount;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TypesOfAccountService
{
    protected int $id;

    public function __construct(private int $i)
    {
        $this->id=$i;

    }

    /*

        gets all information about TypesOfAccount

    */

    public function getTypesOfAccount(): Collection | null 
    {
        $typesOfAccount=TypesOfAccount::query()->get();

        return $typesOfAccount;
    }

    /*

        gets name TypesOfAccount

    */

    public function getName(int $id): Collection | null
    {
        $name=TypesOfAccount::query()->where('id',$id)->get('name');

        return $name;
    }

    /*

        gets intrestId TypesOfAccount

    */


    public function getIntrestId(int $id): Collection | null 
    {
        $intrestId=TypesOfAccount::query()->where('id',$id)->get('intrest_id');

        return $intrestId;
    }

    /*

        creates new TypesOfAccount

    */

    public function createTypesOfAccount(string $name,int $intrestId): Model | null 
    {
        $typeOfAccount=TypesOfAccount::query()->insertGetId([

            'name'=>$name,
            'intrest_id'=>$intrestId,

        ]);

        return $typeOfAccount;
    }

    /*

        updates information about TypesOfAccount

    */

    public function updateTypesOfAccount(int $id,string $name,int $intrestId): int 
    {
        $typeOfAccount=TypesOfAccount::query()->where('id',$id)->update(['name'=>$name,'intrest_id'=>$intrestId]);

        return $typeOfAccount;
    }

    /*

        deletes one TypesOfAccount

    */

    public function deleteTypesOfAccount(int $id): int 
    {
        $typeOfAccount=TypesOfAccount::query()->where('id',$id)->delete();

        return $typeOfAccount;
    }

}