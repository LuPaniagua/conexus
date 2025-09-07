<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Espera;

class EsperaController extends Controller
{
    public function salasAgendadas()
{
    $userId = auth()->id();

    // Busca as salas com a relação correta
    $salas = \App\Models\Sala::with([
    'laudosPendentes' => function($query) use ($userId) {
        $query->where('user_id', $userId);
    },
    'usuarios'
])
->whereHas('usuarios', function($query) use ($userId) {
    $query->where('usuario_id', $userId);
})
->orderBy('data')
->orderBy('hora')
->get();

    return view('espera_de_salas', compact('salas'));
}

}