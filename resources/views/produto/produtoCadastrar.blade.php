@extends('base')
@section('titulo', 'Formulário Produto')
@section('conteudo')

    @php
        if (!empty($dado->id)) {
            $action = route('produto.update', $dado->id);
        } else {
            $action = route('produto.store');
        }
    @endphp

    <form action="{{ $action }}" method="post" enctype="multipart/form-data">
        @csrf

        @if (!empty($dado->id))
            @method('put')
        @endif

        <div class="row">
            <div class="col-md-6">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ old('nome', $dado->nome ?? '') }}">
                @error('nome')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="preco">Preço</label>
                <input type="number" name="preco" step="0.01" class="form-control"
                    value="{{ old('preco', $dado->preco ?? '') }}">
                @error('preco')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-6">
                <label for="categoria_id">Categoria</label>
                <select name="categoria_id" class="form-control">
                    @foreach ($categorias as $item)
                        <option value="{{ $item->id }}" {{ old('categoria_id', $dado->categoria_id ?? '') == $item->id ? 'selected' : '' }}>
                            {{ $item->nome }}
                        </option>
                    @endforeach
                </select>
                @error('categoria_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-md-6">
            <label for="imagem">Imagem</label>
            <input type="file" name="imagem" class="form-control">
            @error('imagem')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <label for="descricao">Descrição</label>
                <textarea name="descricao" class="form-control"
                    rows="4">{{ old('descricao', $dado->descricao ?? '') }}</textarea>
                @error('descricao')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <button type="submit" class="btn btn-success">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}</button>
                <a href="{{ url('produto') }}" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
@endsection