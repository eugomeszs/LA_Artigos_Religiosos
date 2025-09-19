@extends('base')
@section('titulo', 'Clientes')
@section('conteudo')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('cliente.create') }}" class="btn btn-primary mb-3">Novo Cliente</a>

    <form action="{{ route('cliente.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="busca" class="form-control" placeholder="Buscar cliente por nome ou CPF...">
            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
        </div>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $item)
                <tr>
                    <td>{{$item->nome}}</td>
                    <td>{{$item->cpf}}</td>
                    <td>{{$item->telefone}}</td>
                    <td>
                        <a href="{{ route('cliente.edit', $item->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('cliente.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja deletar?')">Deletar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop