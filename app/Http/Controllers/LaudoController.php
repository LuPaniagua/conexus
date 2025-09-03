<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laudo;

class LaudoController extends Controller
{
    public function create()
    {
        return view('cadastralaudo');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string',
            'data-nascimento' => 'required|date',
            'rg' => 'required|string',
            'cpf' => 'required|string',
            'medico' => 'required|string',
            'crm' => 'required|string',
            'especialidade' => 'required|string',
            'contato-medico' => 'required|string',
            'detalhes' => 'required|string',
            'diagnostico' => 'required|string',
            'arquivo-pdf' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('arquivo-pdf')) {
            $path = $request->file('arquivo-pdf')->store('laudos', 'public');
        }

        Laudo::create([
            'nome' => $validated['nome'],
            'data_nascimento' => $validated['data-nascimento'],
            'rg' => $validated['rg'],
            'cpf' => $validated['cpf'],
            'medico' => $validated['medico'],
            'crm' => $validated['crm'],
            'especialidade' => $validated['especialidade'],
            'contato_medico' => $validated['contato-medico'],
            'detalhes' => $validated['detalhes'],
            'diagnostico' => $validated['diagnostico'],
            'arquivo_pdf' => $path,
        ]);

        return redirect()->route('cadastrarlaudo')->with('success', 'Laudo cadastrado com sucesso!');
    }
}
