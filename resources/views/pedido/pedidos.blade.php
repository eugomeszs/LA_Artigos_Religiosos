@extends('base')
@section('titulo', 'Pedidos')
@section('conteudo')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <h2 class="mb-4">Lista de Pedidos</h2>

    <div class="mb-3">
        <a href="{{ route('pedidos.create') }}" class="btn text-white" style="background-color: #718c5e;">
            <i class="bi bi-plus-lg"></i> Novo Pedido
        </a>

        <a href="{{ route('pedidos.chartValor') }}" class="btn btn-warning">
            <i class="fa-solid fa-chart-line"></i> Ver Gráfico de Receita
        </a>

        <a href="{{ route('pedidos.report') }}" class="btn btn-danger" target="_blank">
            <i class="fa-solid fa-file-pdf"></i> Gerar Relatório (PDF)
        </a>
    </div>

    <form action="{{ route('pedidos.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="busca" class="form-control" placeholder="Buscar por ID do pedido ou nome do cliente..."
                value="{{ request('busca') }}" style="border-radius: 5px;">
            <button class="btn text-white" type="submit"
                style="background-color: #718c5e; border-radius: 5px;">Buscar</button>
        </div>
    </form>

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Cliente</th>
                <th scope="col">Data</th>
                <th scope="col">Valor Total</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pedidos as $pedido)
                <tr>
                    <td>#{{ $pedido->id }}</td>
                    <td>{{ $pedido->cliente->nome ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($pedido->data_pedido)->format('d/m/Y H:i') }}</td>
                    <td>R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</td>
                    

                    <td>
                        <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-info btn-sm text-white">Ver</a>
                        <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>Editar
                        </a>
                        <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm text-black" style="background-color: #ff0019ff;"
                                onclick="return confirm('Tem certeza que deseja deletar o pedido #{{ $pedido->id }}?')">
                                <i class="bi bi-trash-fill"></i> Deletar
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Nenhum pedido encontrado!</td> 
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection