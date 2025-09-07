<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Espera extends Model
{
    // Não precisa de uma tabela extra se for manipular salas
    protected $fillable = ['sala_id', 'user_id'];

    // Relacionamento com a Sala
    public function sala()
    {
        return $this->belongsTo(Sala::class, 'sala_id');
    }

    // Relacionamento com o LaudoPendente
    public function laudoPendente()
    {
        return $this->hasOne(LaudoPendente::class, 'sala_id')->where('user_id', auth()->id());
    }

    // Método para checar o status do laudo
    public function verificarStatusLaudo()
    {
        $laudo = $this->laudoPendente;

        if ($laudo) {
            return $laudo->status;  // "pendente", "aprovado" ou "rejeitado"
        }

        return null; // Se não houver laudo pendente
    }

    // Verificar se a conversa está dentro do limite para entrar
    public function podeEntrar()
    {
        $sala = $this->sala;
        $dataHoraSala = Carbon::parse($sala->data . ' ' . $sala->hora);
        $agora = Carbon::now();

        return $dataHoraSala->diffInMinutes($agora, false) <= 5 && $dataHoraSala->diffInMinutes($agora, false) > -60;
    }

    // Método para verificar se o laudo foi aprovado
    public function laudoAprovado()
    {
        return $this->verificarStatusLaudo() === 'aprovado';
    }

    // Método para verificar se o laudo foi rejeitado
    public function laudoRejeitado()
    {
        return $this->verificarStatusLaudo() === 'rejeitado';
    }

    // Método para verificar se o laudo está pendente
    public function laudoPendenteStatus()
    {
        return $this->verificarStatusLaudo() === 'pendente';
    }
}