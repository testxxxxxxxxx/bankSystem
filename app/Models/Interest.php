<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\typesOfAccount;
use App\Models\DepositIncluded;

class Interest extends Model
{
    use HasFactory;

    protected $table='interests';

    protected $fillable=[

        'value',

    ];

    public function typesOfAccount(): HasMany
    {

        return $this->hasMany(typesOfAccount::class);
    }
    public function depositIncluded(): HasMany
    {

        return $this->hasMany(DepositIncluded::class);
    }

}
