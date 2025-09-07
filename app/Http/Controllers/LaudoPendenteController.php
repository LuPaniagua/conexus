<?php

namespace App\Http\Controllers;

use App\Models\LaudoPendente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaudoPendenteController extends Controller
{
    public function create()
    {
        // Se quiser, pode passar dados para a view, como salas, por exemplo
        $salas = \App\Models\Sala::all();
        return view('laudo_pendente.create', compact('salas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'arquivo-pdf' => 'required|file|mimes:pdf|max:2048',
            'sala_id' => 'required|exists:salas,id',
        ]);

        $caminhoArquivo = $request->file('arquivo-pdf')->store('laudos_pendentes', 'public');

        LaudoPendente::create([
            'user_id' => Auth::id(),
            'sala_id' => $validated['sala_id'],
            'caminho_arquivo' => $caminhoArquivo,
            'status' => 'pendente',
        ]);

        return redirect()->route('laudo.pendente.create')->with('success', 'Laudo enviado para validação.');
    }

    public function index()
    {
        $laudos = LaudoPendente::where('status', 'pendente')->get();
        return view('laudo_pendente.index', compact('laudos'));
    }

    public function approve($id)
    {
        $laudo = LaudoPendente::findOrFail($id);

        // Criar o laudo definitivo (você pode adaptar conforme o modelo do seu Laudo)
        \App\Models\Laudo::create([
            'usuario_id' => $laudo->user_id,
            'arquivo_pdf' => $laudo->caminho_arquivo,
            'status' => 'aprovado',
            // Preencha aqui outros campos que forem obrigatórios, se necessário
        ]);

        // Apagar o pendente após aprovação
        $laudo->delete();

        return back()->with('success', 'Laudo aprovado com sucesso.');
    }

    public function reject($id)
    {
        $laudo = LaudoPendente::findOrFail($id);
        $laudo->status = 'rejeitado';
        $laudo->save();

        return back()->with('info', 'Laudo rejeitado.');
    }
}