<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\typesOfAccount;

class intrest extends Model
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

}
