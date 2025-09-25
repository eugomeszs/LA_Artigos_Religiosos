@extends('base')
@section('titulo', 'Categorias')
@section('conteudo')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('categorias.create') }}" class="btn text-white mb-3" style="background-color: #718c5e;">
        Nova Categoria
    </a>

    <form action="{{ route('categorias.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="busca" class="form-control" placeholder="Buscar categoria..." style="border-radius: 5px;">
            <button class="btn text-white" type="submit" style="background-color: #718c5e; border-radius: 5px;">Buscar</button>
        </div>
    </form>

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Religião</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->id }}</td>
                    <td>{{ $categoria->nome }}</td>
                    <td>{{ $categoria->religiao }}</td>
                    <td>
                        <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-sm text-white" style="background-color: #f7a627;">
                            Editar
                        </a>
                        <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm text-white" style="background-color: #dc3545;"
                                onclick="return confirm('Tem certeza que deseja deletar?')">
                                Deletar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
