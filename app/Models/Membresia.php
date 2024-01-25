<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Membresia extends BaseModel
{
    use HasFactory;

    protected $fillable = ['nome', 'quantidade', 'id_usuario', 'created_at'];

    protected $dates = ['created_at', 'updated_at'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
        ->logFillable()
        ->logOnly(['user.name'])
        ->useLogName('Membresia');
    }

    public static function rules(): array
    {
        return [
            'nome' => 'required|max:20',
            'quantidade' => 'required',
            'id_usuario' => 'exists:users,id'
        ];
    }

    public static function feedback(): array
    {
        return [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.max' => 'O campo :attribute não pode ultrapassar 20 caracteres.',
            'id_usuario.exists' => 'O usuário informado não existe!'
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'id_usuario', 'id');
    }
}
