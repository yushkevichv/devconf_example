<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsefulLog extends Model
{
    const LOG_FILE_NAME = 'log_activity.csv';

    protected $fillable = [
        'modellable_type',
        'modellable_id',
        'extra_data'
    ];
}
