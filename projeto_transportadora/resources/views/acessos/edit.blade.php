@extends('layout')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">Editar Acesso</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('acessos.update', $acesso->id) }}" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label for="visitante_id" class="block text-gray-700 text-sm font-bold mb-2">Visitante</label>
            <select id="visitante_id" name="visitante_id" 
                    class="w-full px-3 py-2 border rounded-lg @error('visitante_id') border-red-500 @enderror" required>
                <option value="">-- Selecione um visitante --</option>
                @foreach($visitantes as $visitante)
                    <option value="{{ $visitante->id }}" 
                            {{ old('visitante_id', $acesso->visitante_id) == $visitante->id ? 'selected' : '' }}>
                        {{ $visitante->nome }} - {{ $visitante->documento }}
                    </option>
                @endforeach
            </select>
            @error('visitante_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="motivo_visita" class="block text-gray-700 text-sm font-bold mb-2">Motivo da Visita</label>
            <input type="text" id="motivo_visita" name="motivo_visita" 
                   class="w-full px-3 py-2 border rounded-lg @error('motivo_visita') border-red-500 @enderror"
                   value="{{ old('motivo_visita', $acesso->motivo_visita) }}">
            @error('motivo_visita')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="responsavel_interno" class="block text-gray-700 text-sm font-bold mb-2">Responsável Interno</label>
            <input type="text" id="responsavel_interno" name="responsavel_interno" 
                   class="w-full px-3 py-2 border rounded-lg @error('responsavel_interno') border-red-500 @enderror"
                   value="{{ old('responsavel_interno', $acesso->responsavel_interno) }}">
            @error('responsavel_interno')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="data_hora_entrada" class="block text-gray-700 text-sm font-bold mb-2">Data/Hora de Entrada</label>
            <input type="datetime-local" id="data_hora_entrada" name="data_hora_entrada" 
                   class="w-full px-3 py-2 border rounded-lg @error('data_hora_entrada') border-red-500 @enderror"
                   value="{{ old('data_hora_entrada', $acesso->data_hora_entrada->format('Y-m-d\TH:i')) }}" required>
            @error('data_hora_entrada')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="data_hora_saida" class="block text-gray-700 text-sm font-bold mb-2">Data/Hora de Saída (opcional)</label>
            <input type="datetime-local" id="data_hora_saida" name="data_hora_saida" 
                   class="w-full px-3 py-2 border rounded-lg @error('data_hora_saida') border-red-500 @enderror"
                   value="{{ old('data_hora_saida', $acesso->data_hora_saida ? $acesso->data_hora_saida->format('Y-m-d\TH:i') : '') }}">
            @error('data_hora_saida')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('acessos.index') }}" 
               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Atualizar Acesso
            </button>
        </div>
    </form>
</div>
@endsection
