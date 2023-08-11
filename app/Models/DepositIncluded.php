<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;
use App\Models\Interest;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DepositIncluded extends Model
{
    use HasFactory;

    protected $table="deposits_included";

    protected $fillable=[

        'interest_id',
        'account_id',
        'start',
        'stop',

    ];

    public function accountId(): BelongsTo
    {

        return $this->belongsTo(Account::class);
    }
    public function interestId(): BelongsTo
    {

        return $this->belongsTo(Interest::class);
    }

}
