<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laudo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'data_nascimento',
        'rg',
        'cpf',
        'medico',
        'crm',
        'especialidade',
        'contato_medico',
        'detalhes',
        'diagnostico',
        'arquivo_pdf',
    ];
}
