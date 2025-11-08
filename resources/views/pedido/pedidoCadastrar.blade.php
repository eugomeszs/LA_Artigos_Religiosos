@extends('base')
@section('titulo', $dado->id ? 'Editar Pedido #' . $dado->id : 'Registrar Novo Pedido')
@section('conteudo')

<h2 class="mb-4">{{ $dado->id ? 'Editar Pedido #' . $dado->id : 'Registrar Novo Pedido' }}</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif

<form method="POST"
      action="{{ $dado->id ? route('pedidos.update', $dado->id) : route('pedidos.store') }}">
    @csrf

    @if($dado->id)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="cliente_id" class="form-label">Cliente <span class="text-danger">*</span></label>
        <select class="form-select" id="cliente_id" name="cliente_id" {{ $dado->id ? 'disabled' : 'required' }}>
            <option value="">Selecione o Cliente</option>
            @foreach($clientes as $cliente)
                <option value="{{ $cliente->id }}" 
                    @if($dado->id)
                        {{ $dado->cliente_id == $cliente->id ? 'selected' : '' }}
                    @else
                        {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}
                    @endif
                >
                    {{ $cliente->nome }} ({{ $cliente->email }})
                </option>
            @endforeach
        </select>
        @if($dado->id)
            <input type="hidden" name="cliente_id" value="{{ $dado->cliente_id }}">
            <small class="form-text text-muted">O cliente não pode ser alterado após a criação do pedido.</small>
        @endif
    </div>

    {{-- Bloco de Status removido daqui --}}

    <div class="mb-3">
        <label for="endereco_entrega" class="form-label">Endereço de Entrega <span class="text-danger"></span></label>
        <textarea class="form-control" id="endereco_entrega" name="endereco_entrega" rows="3" required>{{ old('endereco_entrega', $dado->endereco_entrega) }}</textarea>
    </div>

    <h3 class="mt-5 mb-3">Itens do Pedido</h3>

    @if(!$dado->id)
        <p class="text-muted">Selecione pelo menos um produto. Esta interface simplificada suporta apenas um item por pedido.</p>
        <div class="row g-3 border p-3 rounded mb-4">
            <div class="col-md-8">
                <label for="produto_0_id" class="form-label">Produto <span class="text-danger">*</span></label>
                <select class="form-select" id="produto_0_id" name="produtos[0][id]" required>
                    <option value="">Selecione o Produto</option>
                    @foreach($produtos as $produto)
                        <option value="{{ $produto->id }}" data-preco="{{ $produto->preco }}"
                            {{ old('produtos.0.id') == $produto->id ? 'selected' : '' }}>
                            {{ $produto->nome }} (R$ {{ number_format($produto->preco, 2, ',', '.') }})
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label for="produto_0_quantidade" class="form-label">Quantidade <span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="produto_0_quantidade" name="produtos[0][quantidade]"
                       value="{{ old('produtos.0.quantidade', 1) }}" min="1" required>
            </div>
        </div>
    @else
        <table class="table table-sm table-bordered">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th class="text-center">Qtd.</th>
                    <th class="text-end">Preço Unitário</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dado->produtos as $produto)
                    <tr>
                        <td>{{ $produto->nome }}</td>
                        <td class="text-center">{{ $produto->pivot->quantidade }}</td>
                        <td class="text-end">R$ {{ number_format($produto->pivot->preco_unitario, 2, ',', '.') }}</td>
                        <td class="text-end">R$ {{ number_format($produto->pivot->quantidade * $produto->pivot->preco_unitario, 2, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Valor Total:</td>
                    <td class="text-end fw-bold">R$ {{ number_format($dado->valor_total, 2, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
        <small class="form-text text-muted">A alteração de itens no pedido não é permitida nesta interface de edição simplificada.</small>
    @endif

    <div class="mt-4">
        <button type="submit" class="btn text-white" style="background-color: #718c5e;">
            {{ $dado->id ? 'Atualizar Pedido' : 'Finalizar Pedido' }}
        </button>
        <a href="{{ route('pedidos.index') }}" class="btn text-white" style="background-color: #384236;">Voltar</a>
    </div>

</form>

@stop