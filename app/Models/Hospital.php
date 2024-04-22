<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;

class Hospital extends BaseModel
{
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnly(['user.name'])
        ->useLogName('Visita Hospital');
    }
}
