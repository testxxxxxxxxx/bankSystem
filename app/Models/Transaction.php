<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $table="transactions";

    protected $fillable=[

        'from',
        'to',
        'amount',
        'date',
        'time',

    ];

    public function from(): BelongsTo
    {

        return $this->belongsTo(Account::class,'id','from');
    }
    public function to(): BelongsTo
    {

        return $this->belongsTo(Account::class,'id','to');
    }

}
