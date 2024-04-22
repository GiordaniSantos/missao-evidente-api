<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;

class Escola extends Visita
{
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnly(['user.name'])
        ->useLogName('Visita Escola');
    }
}
