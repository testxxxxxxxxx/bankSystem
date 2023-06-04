<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;
use App\Models\Interest;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TypesOfAccount extends Model
{
    use HasFactory;

    protected $table='types_of_account';

    protected $fillable=[

        'name',
        'interest_id',

    ];

    public function accounts(): HasMany
    {

        return $this->hasMany(Account::class);
    }
    public function interestId(): BelongsTo
    {

        return $this->belongsTo(Interest::class);
    }

}
