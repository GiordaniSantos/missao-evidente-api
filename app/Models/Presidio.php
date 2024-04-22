<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;

class Presidio extends Visita
{
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnly(['user.name'])
        ->useLogName('Visita Presidio');
    }
}
