@extends('base')
@section('titulo', 'Fornecedores')
@section('conteudo')

@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<h2 class="mb-4">Lista de Fornecedores</h2>

<a href="{{ route('fornecedores.create') }}" class="btn text-white mb-3" style="background-color: #718c5e;">
    Novo Fornecedor
</a>

<form action="{{ route('fornecedores.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="busca" class="form-control" placeholder="Buscar por nome fantasia, CNPJ ou Razão Social..." value="{{ request('busca') }}" style="border-radius: 5px;">
        <button class="btn text-white" type="submit" style="background-color: #718c5e; border-radius: 5px;">Buscar</button>
    </div>
</form>

<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th scope="col">Nome Fantasia</th>
            <th scope="col">CNPJ</th>
            <th scope="col">E-mail de Contato</th>
            <th scope="col">Telefone</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse($fornecedores as $fornecedor)
            <tr>
                <td>{{ $fornecedor->nome_fantasia }}</td>
                <td>{{ $fornecedor->cnpj ?? 'N/A' }}</td>
                <td>{{ $fornecedor->email_contato }}</td>
                <td>{{ $fornecedor->telefone }}</td>
                <td>
                    <a href="{{ route('fornecedores.edit', $fornecedor->id) }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ route('fornecedores.destroy', $fornecedor->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Tem certeza que deseja deletar o fornecedor {{ $fornecedor->nome_fantasia }}?')">
                            <i class="bi bi-trash-fill"></i> Deletar
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">Nenhum fornecedor encontrado.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@stop