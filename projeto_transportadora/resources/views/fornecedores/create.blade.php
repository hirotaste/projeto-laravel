@extends('layout')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">Novo Fornecedor</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('fornecedores.store') }}" class="space-y-4">
        @csrf
        
        <div>
            <label for="razao_social" class="block text-gray-700 text-sm font-bold mb-2">Razão Social</label>
            <input type="text" id="razao_social" name="razao_social" 
                   class="w-full px-3 py-2 border rounded-lg @error('razao_social') border-red-500 @enderror"
                   value="{{ old('razao_social') }}" required>
            @error('razao_social')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="cnpj" class="block text-gray-700 text-sm font-bold mb-2">CNPJ</label>
            <input type="text" id="cnpj" name="cnpj" 
                   class="w-full px-3 py-2 border rounded-lg @error('cnpj') border-red-500 @enderror"
                   value="{{ old('cnpj') }}" maxlength="14" required>
            @error('cnpj')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="responsavel" class="block text-gray-700 text-sm font-bold mb-2">Responsável</label>
            <input type="text" id="responsavel" name="responsavel" 
                   class="w-full px-3 py-2 border rounded-lg @error('responsavel') border-red-500 @enderror"
                   value="{{ old('responsavel') }}">
            @error('responsavel')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('fornecedores.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Cadastrar Fornecedor
            </button>
        </div>
    </form>
</div>
@endsection
