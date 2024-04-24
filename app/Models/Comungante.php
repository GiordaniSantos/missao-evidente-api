<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;

class Comungante extends Model
{
    use HasFactory;

    protected $fillable = ['id_usuario', 'quantidade', 'created_at'];

    public static function rules(): array
    {
        return [
            'id_usuario' => 'exists:users,id',
            'quantidade' => 'numeric',
        ];
    }

    public static function feedback(): array
    {
        return [
            'id_usuario.exists' => 'O usuário informado não existe!',
            'quantidade.numeric' => 'O campo :attribute deve ser do tipo número.',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'id_usuario', 'id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnly(['user.name'])
        ->useLogName('Comungantes');
    }
}
