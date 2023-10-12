<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sermao extends Model
{
    use HasFactory;

    protected $fillable = ['id_usuario', 'created_at'];

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
}
