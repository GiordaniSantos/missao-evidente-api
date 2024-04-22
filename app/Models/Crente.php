<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Crente extends BaseModel
{
    use HasFactory;

    protected $fillable = ['id_usuario', 'nome', 'created_at'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnly(['user.name'])
        ->useLogName('Visita Crente');
    }

    public static function rules(): array
    {
        return [
            'id_usuario' => 'exists:users,id',
            'nome' => 'max:150',
        ];
    }

    public static function feedback(): array
    {
        return [
            'id_usuario.exists' => 'O usuário informado não existe!',
            'nome.max' => 'O campo :attribute não pode ultrapassar 150 caracteres.',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'id_usuario', 'id');
    }
}
