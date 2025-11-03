@extends('layout')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Detalhes do Fornecedor</h1>
        <div>
            <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" 
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                Editar
            </a>
            <a href="{{ route('fornecedores.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Voltar
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <p class="text-gray-600 text-sm font-semibold">Razão Social</p>
            <p class="text-gray-900 text-lg">{{ $fornecedor->razao_social }}</p>
        </div>

        <div>
            <p class="text-gray-600 text-sm font-semibold">CNPJ</p>
            <p class="text-gray-900 text-lg">{{ $fornecedor->cnpj }}</p>
        </div>

        <div>
            <p class="text-gray-600 text-sm font-semibold">Responsável</p>
            <p class="text-gray-900 text-lg">{{ $fornecedor->responsavel ?? '-' }}</p>
        </div>
    </div>
</div>
@endsection
