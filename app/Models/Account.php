<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\typesOfAccount;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

}
