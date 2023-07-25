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

        gets interest value

    */

    public function getInterest(int $id): array | null 
    {
        $interest=Interest::query()->findOrFail($id)->get()->toArray();

        return $interest[0]['value'];
    }

    /*

        creates interest

    */

    public function createInterest(float $value): int | null 
    {
        $interest=Interest::query()->insertGetId([

            'value'=>$value,

        ]);

        return $interest;
    }

    /*

        updates value of interest

    */

    public function updateInterest(int $id,float $value): int 
    {
        $interest=Interest::query()->where('id',$id)->update(['value'=>$value]);

        return $interest;
    }

    /*

        deletes interest

    */

    public function deleteInterest(int $id): int 
    {
        $interest=Interest::query()->where('id',$id)->delete();

        return $interest;
    }

}