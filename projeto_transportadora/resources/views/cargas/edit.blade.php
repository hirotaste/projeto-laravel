@extends('layout')

@section('content')
<div class="bg-white shadow rounded p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-4">Editar Carga</h2>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cargas.update', $carga->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-sm font-medium text-gray-700">Tipo*</label>
            <input type="text" name="tipo" value="{{ old('tipo', $carga->tipo) }}" required class="mt-1 block w-full border-gray-300 rounded-md" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Peso</label>
            <input type="number" step="0.01" name="peso" value="{{ old('peso', $carga->peso) }}" class="mt-1 block w-full border-gray-300 rounded-md" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Volume</label>
            <input type="number" step="0.01" name="volume" value="{{ old('volume', $carga->volume) }}" class="mt-1 block w-full border-gray-300 rounded-md" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Origem</label>
            <input type="text" name="origem" value="{{ old('origem', $carga->origem) }}" class="mt-1 block w-full border-gray-300 rounded-md" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Destino</label>
            <input type="text" name="destino" value="{{ old('destino', $carga->destino) }}" class="mt-1 block w-full border-gray-300 rounded-md" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Veículo</label>
            <select name="veiculo_id" class="mt-1 block w-full border-gray-300 rounded-md">
                <option value="">Selecione...</option>
                @foreach($veiculos as $v)
                    <option value="{{ $v->id }}" {{ old('veiculo_id', $carga->veiculo_id) == $v->id ? 'selected' : '' }}>
                        {{ $v->placa }} - {{ $v->modelo }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Motorista</label>
            <select name="motorista_id" class="mt-1 block w-full border-gray-300 rounded-md">
                <option value="">Selecione...</option>
                @foreach($motoristas as $m)
                    <option value="{{ $m->id }}" {{ old('motorista_id', $carga->motorista_id) == $m->id ? 'selected' : '' }}>
                        {{ $m->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('cargas.index') }}" class="px-4 py-2 bg-gray-200 rounded">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Atualizar</button>
        </div>
    </form>
</div>
@endsection
