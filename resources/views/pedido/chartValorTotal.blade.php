@extends('base')
@section('titulo', 'Gráfico de Receita')
@section('conteudo')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <div class="container mt-5">

        <h3 class="mb-3">Gráfico do Valor Total Por Dia</h3>

        <div class="card p-4 shadow-sm">
            {!! $chart->container() !!}
        </div>

        <div class="mt-3">
            <a href="{{ route('pedidos.index') }}" class="btn text-white" style="background-color: #384236;">
                Voltar para Pedidos
            </a>
        </div>

    </div>

    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}

@endsection