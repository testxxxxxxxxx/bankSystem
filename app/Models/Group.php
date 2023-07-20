<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Privileges;

class Group extends Model
{
    use HasFactory;

    protected $table="groups";

    protected $fillable=[

        'name',
        'privileges',

    ];

    public function user(): HasMany
    {

        return $this->hasMany(User::class);
    }
    public function privileges(): HasMany
    {

        return $this->hasMany(Privileges::class);
    }

}
