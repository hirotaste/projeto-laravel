@extends('layout')

@section('content')
<div class="bg-white shadow rounded p-6 max-w-2xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Detalhes da Carga</h2>
        <div>
            <a href="{{ route('cargas.edit', $carga->id) }}" 
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                Editar
            </a>
            <a href="{{ route('cargas.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Voltar
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <p class="text-gray-600 text-sm font-semibold">Tipo</p>
            <p class="text-gray-900 text-lg">{{ $carga->tipo }}</p>
        </div>

        <div>
            <p class="text-gray-600 text-sm font-semibold">Peso (kg)</p>
            <p class="text-gray-900 text-lg">{{ $carga->peso ?? '-' }}</p>
        </div>

        <div>
            <p class="text-gray-600 text-sm font-semibold">Volume (m³)</p>
            <p class="text-gray-900 text-lg">{{ $carga->volume ?? '-' }}</p>
        </div>

        <div>
            <p class="text-gray-600 text-sm font-semibold">Origem</p>
            <p class="text-gray-900 text-lg">{{ $carga->origem ?? '-' }}</p>
        </div>

        <div>
            <p class="text-gray-600 text-sm font-semibold">Destino</p>
            <p class="text-gray-900 text-lg">{{ $carga->destino ?? '-' }}</p>
        </div>

        <div>
            <p class="text-gray-600 text-sm font-semibold">Veículo</p>
            <p class="text-gray-900 text-lg">
                {{ $carga->veiculo ? $carga->veiculo->placa . ' - ' . $carga->veiculo->modelo : '-' }}
            </p>
        </div>

        <div>
            <p class="text-gray-600 text-sm font-semibold">Motorista</p>
            <p class="text-gray-900 text-lg">
                {{ $carga->motorista ? $carga->motorista->nome : '-' }}
            </p>
        </div>
    </div>
</div>
@endsection
