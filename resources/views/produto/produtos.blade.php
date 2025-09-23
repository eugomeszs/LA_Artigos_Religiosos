@extends('base')
@section('titulo', 'Produtos')
@section('conteudo')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('produto.create') }}" class="btn text-white mb-3" style="background-color: #718c5e;">
        Novo Produto
    </a>

    <form action="{{ route('produto.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="busca" class="form-control" placeholder="Buscar produto..." style="border-radius: 5px;">
            <button class="btn text-white" type="submit" style="background-color: #718c5e; border-radius: 5px;">Buscar</button>
        </div>
    </form>

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>Imagem Ilustrativa</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produtos as $produto)
                <tr>
                    <td>
                        @if($produto->imagem)
                            <img src="{{ asset('storage/' . $produto->imagem) }}" alt="Imagem do Produto" style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                            <div class="bg-light border" style="width: 80px; height: 80px;"></div>
                        @endif
                    </td>
                    <td>{{ $produto->nome }}</td>
                    <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                    <td>{{ $produto->categoria->nome }}</td>
                    <td>
                        <a href="{{ route('produto.edit', $produto->id) }}" class="btn btn-sm text-white" style="background-color: #f7a627;">
                            Editar
                        </a>
                        <form action="{{ route('produto.destroy', $produto->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm text-white" style="background-color: #dc3545;" onclick="return confirm('Tem certeza que deseja deletar?')">
                                Deletar
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection