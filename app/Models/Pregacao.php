<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregacao extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'quantidade', 'id_usuario'];

    protected $dates = ['created_at', 'updated_at'];

    public static function rules(){
        $regras = [
            'nome' => 'required|max:25',
            'quantidade' => 'required',
            'id_usuario' => 'exists:users,id'
        ];

        return $regras;
    }

    public static function feedback(){
        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.max' => 'O campo :attribute não pode ultrapassar 25 caracteres.',
            'id_usuario.exists' => 'O usuário informado não existe!'
        ];

        return $feedback;
    }
}
