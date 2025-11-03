@extends('layout')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Detalhes do Visitante</h1>
        <div>
            <a href="{{ route('visitantes.edit', $visitante->id) }}" 
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                Editar
            </a>
            <a href="{{ route('visitantes.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Voltar
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <p class="text-gray-600 text-sm font-semibold">Nome</p>
            <p class="text-gray-900 text-lg">{{ $visitante->nome }}</p>
        </div>

        <div>
            <p class="text-gray-600 text-sm font-semibold">Documento</p>
            <p class="text-gray-900 text-lg">{{ $visitante->documento }}</p>
        </div>

        <div>
            <p class="text-gray-600 text-sm font-semibold">Empresa</p>
            <p class="text-gray-900 text-lg">{{ $visitante->empresa ?? '-' }}</p>
        </div>

        <div>
            <p class="text-gray-600 text-sm font-semibold">Função</p>
            <p class="text-gray-900 text-lg">{{ $visitante->funcao ? $visitante->funcao->descricao : '-' }}</p>
        </div>
    </div>

    @if($visitante->acessos->isNotEmpty())
    <div class="mt-8">
        <h2 class="text-xl font-bold mb-4">Histórico de Acessos</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data/Hora Entrada</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data/Hora Saída</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Motivo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Responsável</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($visitante->acessos as $acesso)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $acesso->data_hora_entrada->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $acesso->data_hora_saida ? $acesso->data_hora_saida->format('d/m/Y H:i') : '-' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $acesso->motivo_visita ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $acesso->responsavel_interno ?? '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection
