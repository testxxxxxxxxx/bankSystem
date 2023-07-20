<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Privileges;

class Controller extends Model
{
    use HasFactory;

    protected $table="controllers";

    protected $fillable=[

        "name",

    ];

    public function privileges(): HasMany
    {

        return $this->hasMany(Privileges::class);
    }

}
