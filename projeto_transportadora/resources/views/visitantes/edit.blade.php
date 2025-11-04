@extends('layout')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">Editar Visitante</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('visitantes.update', $visitante->id) }}" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Nome</label>
            <input type="text" id="nome" name="nome" 
                   class="w-full px-3 py-2 border rounded-lg @error('nome') border-red-500 @enderror"
                   value="{{ old('nome', $visitante->nome) }}" required>
            @error('nome')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="documento" class="block text-gray-700 text-sm font-bold mb-2">Documento (CPF/RG)</label>
            <input type="text" id="documento" name="documento" 
                   class="w-full px-3 py-2 border rounded-lg @error('documento') border-red-500 @enderror"
                   value="{{ old('documento', $visitante->documento) }}" required>
            @error('documento')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="empresa" class="block text-gray-700 text-sm font-bold mb-2">Empresa</label>
            <input type="text" id="empresa" name="empresa" 
                   class="w-full px-3 py-2 border rounded-lg @error('empresa') border-red-500 @enderror"
                   value="{{ old('empresa', $visitante->empresa) }}">
            @error('empresa')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="funcao_id" class="block text-gray-700 text-sm font-bold mb-2">Função</label>
            <select id="funcao_id" name="funcao_id" 
                    class="w-full px-3 py-2 border rounded-lg @error('funcao_id') border-red-500 @enderror">
                <option value="">-- Selecione uma função --</option>
                @foreach($funcoes as $funcao)
                    <option value="{{ $funcao->id }}" 
                            {{ old('funcao_id', $visitante->funcao_id) == $funcao->id ? 'selected' : '' }}>
                        {{ $funcao->descricao }}
                    </option>
                @endforeach
            </select>
            @error('funcao_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('visitantes.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Atualizar Visitante
            </button>
        </div>
    </form>
</div>
@endsection
