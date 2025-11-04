<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fornecedor;
use Illuminate\Support\Facades\Log;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fornecedores = Fornecedor::paginate(10);
        return view('fornecedores.index', compact('fornecedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fornecedores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|size:14|unique:fornecedores',
            'responsavel' => 'nullable|string|max:255'
        ]);

        try {
            Fornecedor::create($validated);
            return redirect()->route('fornecedores.index')
                ->with('sucesso', 'Fornecedor cadastrado com sucesso!');
        } catch(\Exception $e) {
            Log::error('Erro ao salvar fornecedor: '.$e->getMessage());
            return redirect()->route('fornecedores.index')
                ->with('erro', 'Erro ao inserir fornecedor!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        return view('fornecedores.show', compact('fornecedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fornecedor = Fornecedor::findOrFail($id);
        return view('fornecedores.edit', compact('fornecedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'razao_social' => 'required|string|max:255',
            'cnpj' => 'required|string|size:14|unique:fornecedores,cnpj,'.$id,
            'responsavel' => 'nullable|string|max:255'
        ]);

        try {
            $fornecedor = Fornecedor::findOrFail($id);
            $fornecedor->update($validated);
            return redirect()->route('fornecedores.index')
                ->with('sucesso', 'Fornecedor atualizado com sucesso!');
        } catch(\Exception $e) {
            Log::error('Erro ao atualizar fornecedor: '.$e->getMessage());
            return redirect()->route('fornecedores.index')
                ->with('erro', 'Erro ao atualizar fornecedor!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $fornecedor = Fornecedor::findOrFail($id);
            $fornecedor->delete();
            return redirect()->route('fornecedores.index')
                ->with('sucesso', 'Fornecedor excluído com sucesso!');
        } catch(\Exception $e) {
            Log::error('Erro ao excluir fornecedor: '.$e->getMessage());
            return redirect()->route('fornecedores.index')
                ->with('erro', 'Erro ao excluir fornecedor!');
        }
    }
}
