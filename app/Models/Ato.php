<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ato extends Model
{
    use HasFactory;

    const TIPO_BASTISMO_INFANTIL = 'Batismo Infantil';
    const TIPO_BATISMO_PROFISSAO_FE = 'Batismo e Profissão de Fé';
    const TIPO_BENCAO = 'Benção Nupcial';
    const TIPO_SANTA_CEIA = 'Santa Ceia';

    const LIST_TIPOS = [
        self::TIPO_BASTISMO_INFANTIL => 'Batismo Infantil',
        self::TIPO_BATISMO_PROFISSAO_FE => 'Batismo e Profissão de Fé',
        self::TIPO_BENCAO => 'Benção Nupcial',
        self::TIPO_SANTA_CEIA => 'Santa Ceia'
    ];

    protected $fillable = ['nome', 'quantidade', 'id_usuario'];

    protected $dates = ['created_at', 'updated_at', 'data_publicacao'];

    public static function rules(){
        $regras = [
            'nome' => 'required|max:30',
            'quantidade' => 'required',
            'id_usuario' => 'exists:users,id'
        ];

        return $regras;
    }

    public static function feedback(){
        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
            'nome.max' => 'O campo :attribute não pode ultrapassar 30 caracteres.',
            'id_usuario.exists' => 'O usuário informado não existe!'
        ];

        return $feedback;
    }
}
