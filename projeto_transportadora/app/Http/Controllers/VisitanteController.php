<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitante;
use App\Models\FuncaoVisitante;
use Illuminate\Support\Facades\Log;

class VisitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitantes = Visitante::with('funcao')->paginate(10);
        return view('visitantes.index', compact('visitantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $funcoes = FuncaoVisitante::all();
        return view('visitantes.create', compact('funcoes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'documento' => 'required|string|max:50',
            'empresa' => 'nullable|string|max:255',
            'funcao_id' => 'nullable|exists:funcoes_visitantes,id'
        ]);

        try {
            Visitante::create($validated);
            return redirect()->route('visitantes.index')
                ->with('sucesso', 'Visitante cadastrado com sucesso!');
        } catch(\Exception $e) {
            Log::error('Erro ao salvar visitante: '.$e->getMessage());
            return redirect()->route('visitantes.index')
                ->with('erro', 'Erro ao inserir visitante!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $visitante = Visitante::with('funcao', 'acessos')->findOrFail($id);
        return view('visitantes.show', compact('visitante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $visitante = Visitante::findOrFail($id);
        $funcoes = FuncaoVisitante::all();
        return view('visitantes.edit', compact('visitante', 'funcoes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'documento' => 'required|string|max:50',
            'empresa' => 'nullable|string|max:255',
            'funcao_id' => 'nullable|exists:funcoes_visitantes,id'
        ]);

        try {
            $visitante = Visitante::findOrFail($id);
            $visitante->update($validated);
            return redirect()->route('visitantes.index')
                ->with('sucesso', 'Visitante atualizado com sucesso!');
        } catch(\Exception $e) {
            Log::error('Erro ao atualizar visitante: '.$e->getMessage());
            return redirect()->route('visitantes.index')
                ->with('erro', 'Erro ao atualizar visitante!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $visitante = Visitante::findOrFail($id);
            $visitante->delete();
            return redirect()->route('visitantes.index')
                ->with('sucesso', 'Visitante excluído com sucesso!');
        } catch(\Exception $e) {
            Log::error('Erro ao excluir visitante: '.$e->getMessage());
            return redirect()->route('visitantes.index')
                ->with('erro', 'Erro ao excluir visitante!');
        }
    }
}
