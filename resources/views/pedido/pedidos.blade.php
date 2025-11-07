@extends('base')
@section('titulo', 'Pedidos')
@section('conteudo')

@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<h2 class="mb-4">Lista de Pedidos</h2>

<a href="{{ route('pedidos.create') }}" class="btn text-white mb-3" style="background-color: #718c5e;">
    Novo Pedido
</a>

<form action="{{ route('pedidos.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="busca" class="form-control" placeholder="Buscar por ID do pedido ou nome do cliente..." value="{{ request('busca') }}" style="border-radius: 5px;">
        <button class="btn text-white" type="submit" style="background-color: #718c5e; border-radius: 5px;">Buscar</button>
    </div>
</form>

<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Cliente</th>
            <th scope="col">Data</th>
            <th scope="col">Valor Total</th>
            <th scope="col">Status</th>
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
                    <span class="badge 
                        @if($pedido->status === 'Pendente') bg-warning text-dark
                        @elseif($pedido->status === 'Em Separação') bg-info text-dark
                        @elseif($pedido->status === 'Enviado') bg-primary
                        @elseif($pedido->status === 'Concluído') bg-success
                        @else bg-secondary @endif">
                        {{ $pedido->status }}
                    </span>
                </td>
                <td>
                    <a href="{{ route('pedidos.show', $pedido->id) }}" class="btn btn-info btn-sm text-white">Ver</a>

                    <a href="{{ route('pedidos.edit', $pedido->id) }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ route('pedidos.destroy', $pedido->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Tem certeza que deseja deletar o pedido #{{ $pedido->id }}?')">
                            <i class="bi bi-trash-fill"></i> Deletar
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">Nenhum pedido encontrado.</td>
            </tr>
        @endforelse
    </tbody>
</table>

@stop