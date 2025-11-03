@extends('layout')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Detalhes do Acesso</h1>
        <div>
            <a href="{{ route('acessos.edit', $acesso->id) }}" 
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                Editar
            </a>
            <a href="{{ route('acessos.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Voltar
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <p class="text-gray-600 text-sm font-semibold">Visitante</p>
            <p class="text-gray-900 text-lg">{{ $acesso->visitante->nome }}</p>
        </div>

        <div>
            <p class="text-gray-600 text-sm font-semibold">Documento</p>
            <p class="text-gray-900 text-lg">{{ $acesso->visitante->documento }}</p>
        </div>

        <div>
            <p class="text-gray-600 text-sm font-semibold">Empresa</p>
            <p class="text-gray-900 text-lg">{{ $acesso->visitante->empresa ?? '-' }}</p>
        </div>

        <div>
            <p class="text-gray-600 text-sm font-semibold">Função</p>
            <p class="text-gray-900 text-lg">{{ $acesso->visitante->funcao ? $acesso->visitante->funcao->descricao : '-' }}</p>
        </div>

        <div>
            <p class="text-gray-600 text-sm font-semibold">Data/Hora de Entrada</p>
            <p class="text-gray-900 text-lg">{{ $acesso->data_hora_entrada->format('d/m/Y H:i') }}</p>
        </div>

        <div>
            <p class="text-gray-600 text-sm font-semibold">Data/Hora de Saída</p>
            <p class="text-gray-900 text-lg">{{ $acesso->data_hora_saida ? $acesso->data_hora_saida->format('d/m/Y H:i') : '-' }}</p>
        </div>

        <div class="md:col-span-2">
            <p class="text-gray-600 text-sm font-semibold">Motivo da Visita</p>
            <p class="text-gray-900 text-lg">{{ $acesso->motivo_visita ?? '-' }}</p>
        </div>

        <div class="md:col-span-2">
            <p class="text-gray-600 text-sm font-semibold">Responsável Interno</p>
            <p class="text-gray-900 text-lg">{{ $acesso->responsavel_interno ?? '-' }}</p>
        </div>
    </div>
</div>
@endsection
