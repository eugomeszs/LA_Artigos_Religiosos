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

        <div class="row mb-3">
            <div class="col">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $dado->nome ?? '') }}">
                @error('nome')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <button type="submit" class="btn text-white" style="background-color: #718c5e;">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}</button>
                <a href="{{ url('categoria') }}" class="btn text-white" style="background-color: #384236;">Voltar</a>
            </div>
        </div>
    </form>
@endsection