<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Controller;
use App\Models\Group;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Privileges extends Model
{
    use HasFactory;

    protected $table="privileges";

    protected $fillable=[

        'controllerName'

    ];

    public function controller(): BelongsTo
    {

        return $this->belongsTo(Controller::class);
    }
    public function group(): BelongsTo
    {

        return $this->belongsTo(Group::class);
    }

}
