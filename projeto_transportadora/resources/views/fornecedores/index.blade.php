@extends('layout')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Fornecedores</h1>
        <a href="{{ route('fornecedores.create') }}" 
           class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
            Novo Fornecedor
        </a>
    </div>

    @if(session('sucesso'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('sucesso') }}
        </div>
    @endif
    
    @if(session('erro'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('erro') }}
        </div>
    @endif

    @if($fornecedores->isEmpty())
        <div class="text-gray-500 text-center py-8">
            Nenhum fornecedor cadastrado.
        </div>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Razão Social</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">CNPJ</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Responsável</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($fornecedores as $fornecedor)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $fornecedor->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $fornecedor->razao_social }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $fornecedor->cnpj }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $fornecedor->responsavel ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" 
                               class="text-indigo-600 hover:text-indigo-900 mr-3">Editar</a>
                            <a href="{{ route('fornecedores.show', $fornecedor->id) }}" 
                               class="text-blue-600 hover:text-blue-900">Visualizar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-6">
            {{ $fornecedores->links() }}
        </div>
    @endif
</div>
@endsection
