<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsefulLog extends Model
{
    protected $fillable = [
        'modellable_type',
        'modellable_id',
        'extra_data'
    ];
}
