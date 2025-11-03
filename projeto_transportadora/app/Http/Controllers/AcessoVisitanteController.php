<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcessoVisitante;
use App\Models\Visitante;
use Illuminate\Support\Facades\Log;

class AcessoVisitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $acessos = AcessoVisitante::with('visitante')->orderBy('data_hora_entrada', 'desc')->paginate(10);
        return view('acessos.index', compact('acessos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $visitantes = Visitante::all();
        return view('acessos.create', compact('visitantes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'visitante_id' => 'required|exists:visitantes,id',
            'motivo_visita' => 'nullable|string|max:255',
            'responsavel_interno' => 'nullable|string|max:255',
            'data_hora_entrada' => 'required|date',
            'data_hora_saida' => 'nullable|date|after:data_hora_entrada'
        ]);

        try {
            AcessoVisitante::create($validated);
            return redirect()->route('acessos.index')
                ->with('sucesso', 'Acesso registrado com sucesso!');
        } catch(\Exception $e) {
            Log::error('Erro ao registrar acesso: '.$e->getMessage());
            return redirect()->route('acessos.index')
                ->with('erro', 'Erro ao registrar acesso!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $acesso = AcessoVisitante::with('visitante.funcao')->findOrFail($id);
        return view('acessos.show', compact('acesso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $acesso = AcessoVisitante::findOrFail($id);
        $visitantes = Visitante::all();
        return view('acessos.edit', compact('acesso', 'visitantes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'visitante_id' => 'required|exists:visitantes,id',
            'motivo_visita' => 'nullable|string|max:255',
            'responsavel_interno' => 'nullable|string|max:255',
            'data_hora_entrada' => 'required|date',
            'data_hora_saida' => 'nullable|date|after:data_hora_entrada'
        ]);

        try {
            $acesso = AcessoVisitante::findOrFail($id);
            $acesso->update($validated);
            return redirect()->route('acessos.index')
                ->with('sucesso', 'Acesso atualizado com sucesso!');
        } catch(\Exception $e) {
            Log::error('Erro ao atualizar acesso: '.$e->getMessage());
            return redirect()->route('acessos.index')
                ->with('erro', 'Erro ao atualizar acesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $acesso = AcessoVisitante::findOrFail($id);
            $acesso->delete();
            return redirect()->route('acessos.index')
                ->with('sucesso', 'Acesso excluído com sucesso!');
        } catch(\Exception $e) {
            Log::error('Erro ao excluir acesso: '.$e->getMessage());
            return redirect()->route('acessos.index')
                ->with('erro', 'Erro ao excluir acesso!');
        }
    }
}
