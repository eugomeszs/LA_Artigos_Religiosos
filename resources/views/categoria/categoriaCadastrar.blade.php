@extends('base')
@section('titulo', 'Formulário Categoria')
@section('conteudo')

    @php
        if (!empty($dado->id)) {
            $action = route('categorias.update', $dado->id);
        } else {
            $action = route('categorias.store');
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
            <div class="col">
                <label for="religiao" class="form-label">Religião</label>
                <input type="text" name="religiao" id="religiao" class="form-control" value="{{ old('religiao', $dado->religiao ?? '') }}">
                @error('religiao')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <button type="submit" class="btn text-white" style="background-color: #718c5e;">{{ !empty($dado->id) ? 'Atualizar' : 'Salvar' }}</button>
                <a href="{{ url('categorias') }}" class="btn text-white" style="background-color: #384236;">Voltar</a>
            </div>
        </div>
    </form>
@endsection
