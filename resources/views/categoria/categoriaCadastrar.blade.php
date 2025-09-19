@extends('base')
@section('titulo', 'Formulário Categoria')
@section('conteudo')

    @php
        if (!empty($dado->id)) {
            $action = route('categoria.update', $dado->id);
        } else {
            $action = route('categoria.store');
        }
    @endphp

    <form action="{{ $action }}" method="post">
        @csrf

        @if (!empty($dado->id))
            @method('put')
        @endif

        <div class="row">
            <div class="col">
                <label for="nome">Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ old('nome', $dado->nome ?? '') }}">
                @error('nome')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <button type="submit" class="btn btn-success">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}</button>
                <a href="{{ url('categoria') }}" class="btn btn-primary">Voltar</a>
            </div>
        </div>
    </form>
@endsection