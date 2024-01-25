<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Discipulado extends BaseModel
{
    use HasFactory;

    protected $fillable = ['id_usuario', 'created_at'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnly(['user.name'])
        ->useLogName('Discipulado');
    }

    public static function rules(): array
    {
        return [
            'id_usuario' => 'exists:users,id'
        ];
    }

    public static function feedback(): array
    {
        return [
            'id_usuario.exists' => 'O usuário informado não existe!'
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'id_usuario', 'id');
    }
}
