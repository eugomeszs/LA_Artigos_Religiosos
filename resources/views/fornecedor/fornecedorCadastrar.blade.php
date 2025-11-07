@extends('base')
@section('titulo', $dado->id ? 'Editar Fornecedor' : 'Cadastrar Fornecedor')
@section('conteudo')

<h2 class="mb-4">{{ $dado->id ? 'Editar Fornecedor: ' . $dado->nome_fantasia : 'Cadastrar Novo Fornecedor' }}</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ $dado->id ? route('fornecedores.update', $dado->id) : route('fornecedores.store') }}">
    @csrf

    @if($dado->id)
        @method('PUT')
    @endif

    <div class="mb-3">
        <label for="nome_fantasia" class="form-label">Nome Fantasia <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia"
            value="{{ old('nome_fantasia', $dado->nome_fantasia) }}" required>
    </div>

    <div class="mb-3">
        <label for="razao_social" class="form-label">Razão Social</label>
        <input type="text" class="form-control" id="razao_social" name="razao_social"
            value="{{ old('razao_social', $dado->razao_social) }}">
    </div>

    <div class="mb-3">
        <label for="cnpj" class="form-label">CNPJ</label>
        <input type="text" class="form-control" id="cnpj" name="cnpj" value="{{ old('cnpj', $dado->cnpj) }}"
            placeholder="00.000.000/0000-00">
    </div>

    <div class="mb-3">
        <label for="email_contato" class="form-label">E-mail de Contato</label>
        <input type="email" class="form-control" id="email_contato" name="email_contato"
            value="{{ old('email_contato', $dado->email_contato) }}">
    </div>

    <div class="mb-3">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" class="form-control" id="telefone" name="telefone"
            value="{{ old('telefone', $dado->telefone) }}" placeholder="(XX) XXXXX-XXXX">
    </div>

    <button type="submit" class="btn text-white" style="background-color: #718c5e;">
        {{ $dado->id ? 'Atualizar Fornecedor' : 'Cadastrar Fornecedor' }}
    </button>

    <a href="{{ route('fornecedores.index') }}" class="btn btn-secondary">Cancelar</a>

</form>

@stop