<?php

namespace App\Http\Controllers;

use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Usuario;
use Carbon\Carbon;


class SalaController extends Controller
{
    // Exibir o formulário de criação
    public function create()
    {
        return view('criar-salas');
    }
    // No SalaController.php
    public function index(Request $request)
{
    $user = Auth::user();
    $search = $request->input('search');

    $salas = Sala::with('agendamentos')
        ->whereRaw("CONCAT(data, ' ', hora) > ?", [now()->addMinutes(10)])
        ->when($search, function ($query, $search) {
            $query->where(function ($q) use ($search) {
                $q->where('tema', 'like', "%{$search}%")
                  ->orWhere('nome_medico', 'like', "%{$search}%");
            });
        })
        ->get(); // Executa a query aqui, já com os filtros

        // Para cada sala, verificar se usuário tem laudo registrado
    foreach ($salas as $sala) {
        $sala->temLaudo = $this->verificarSeTemLaudo($user->id, $sala->id);
    }

    return view('salas', compact('salas'));
}

    // Salvar a nova sala no banco
    public function store(Request $request)
    {
        $request->validate([
            'tema' => 'required',
            'data' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'numero_participantes' => 'required|integer',
            'nome_medico' => 'required',
        ]);

        // Convertendo o valor de 'sim' para 1 e 'nao' para 0
        $laudo = $request->laudo === 'sim' ? 1 : 0;

        // Criar a sala no banco
        Sala::create([
            'tema' => $request->tema,
            'descricao' => $request->descricao,
            'data' => $request->data,
            'hora' => $request->hora,
            'numero_participantes' => $request->numero_participantes,
            'nome_medico' => $request->nome_medico,
            'laudo_obrigatorio' => $laudo,  // Passando o valor convertido
            'usuario_id' => Auth::id(), // Associando a sala ao usuário autenticado
        ]);
        

        // Redirecionar ou retornar uma mensagem de sucesso
        return redirect()->route('salas.index')->with('success', 'Sala criada com sucesso!');
    }

        public function agendar(Request $request, $id)
{
    $user = Auth::user();
    $sala = Sala::findOrFail($id);

    $ocupadas = $sala->usuarios()->count();
    $limite = $sala->numero_participantes; // limite máximo

    if ($ocupadas >= $limite) {
        return back()->with('error', 'Sala já está cheia.');
    }

    if ($user->salas()->where('sala_id', $sala->id)->exists()) {
        return back()->with('error', 'Você já agendou essa sala.');
    }

    if ($sala->laudo_obrigatorio) {
        $request->validate([
            'laudo' => 'required|file|mimes:pdf|max:2048',
        ]);

        $path = $request->file('laudo')->store('laudos', 'public');
    } else {
        $path = null;
    }

    $user->salas()->attach($sala->id, ['laudo_path' => $path]);

    // Remova esta linha, pois está alterando o limite:

    return back()->with('success', 'Conversa agendada com sucesso!');
}

        public function salasAgendadas()
{
    $usuario = Auth::user();

    // Salas que o usuário agendou
    $salas = $usuario->salas()->orderBy('data')->orderBy('hora')->get();

    return view('espera_de_salas', compact('salas'));
}
public function espera()
{
    // Buscar só as salas agendadas pelo usuário logado
    $salas = Sala::where('usuario_id', auth()->id())->get();

    // Retorna a view com as salas filtradas
    return view('espera_de_salas', compact('salas'));
}

private function verificarSeTemLaudo($userId, $salaId)
{
    // Como você tem relacionamento many-to-many entre usuários e salas, 
    // e o laudo fica no pivot (ex: laudo_path), podemos usar isso para saber:

    $usuario = Usuario::find($userId);

    if (!$usuario) return false;

    $agendamento = $usuario->salas()->where('sala_id', $salaId)->first();

    if ($agendamento && $agendamento->pivot->laudo_path) {
        return true;
    }

    return false;
}

}
