<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Incredulo extends BaseModel
{
    use HasFactory;

    protected $fillable = ['id_usuario', 'created_at'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnly(['user.name'])
        ->useLogName('Visita Não Crente');
    }

    public static function rules(){
        $regras = [
            'id_usuario' => 'exists:users,id'
        ];

        return $regras;
    }

    public static function feedback(){
        $feedback = [
            'id_usuario.exists' => 'O usuário informado não existe!'
        ];

        return $feedback;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'id_usuario', 'id');
    }
}
