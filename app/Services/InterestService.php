<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Interest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class InterestService
{
    protected int $id;

    public function __construct(private int $i)
    {
        $this->id=$i;
    
    }

    /*

        gets all intrests

    */

    public function getAllInterests(): Collection | null 
    {
        $intrests=Interest::query()->get();

        return $intrests;
    }

    /*

        gets intrest

    */

    public function getInterest(int $id): Collection | null 
    {
        $intrest=Interest::query()->findOrFail($id)->get();

        return $intrest;
    }

    /*

        creates interest

    */

    public function createInterest(int $id,float $value): Model | null 
    {
        $interest=Interest::query()->create([

            'value'=>$value,

        ]);

        return $interest;
    }

    /*

        updates value of interest

    */

    public function updateInterest(int $id,float $value): int 
    {
        $intrest=Interest::query()->where('id',$id)->update(['value'=>$value]);

        return $intrest;
    }

    /*

        deletes interest

    */

    public function deleteInterest(int $id): int 
    {
        $intrest=Interest::query()->where('id',$id)->delete();

        return $intrest;
    }

}