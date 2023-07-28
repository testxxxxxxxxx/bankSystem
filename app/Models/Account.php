<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\typesOfAccount;
use App\Models\Transaction;
use App\Models\DepositIncluded;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory;

    protected $table='accounts';

    protected $fillable=[

        'balance',
        'typeOfAccount',
        'user_id',

    ];

    public function typeOfAccount(): BelongsTo
    {

        return $this->belongsTo(typesOfAccount::class);
    }
    public function userId(): BelongsTo
    {

        return $this->belongsTo(User::class);
    }
    public function transactions(): HasMany
    {

        return $this->hasMany(Transaction::class,'from');
    }
    public function depositIncluded(): HasMany
    {

        return $this->hasMany(DepositIncluded::class);
    }

}
