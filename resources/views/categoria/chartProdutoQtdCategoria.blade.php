@extends('base')
@section('titulo', 'Gráfico de Categorias')
@section('conteudo')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <div class="container mt-5">

        <h3 class="mb-3">Gráfico de Produtos por Categoria</h3>

        <div class="card p-4 shadow-sm">
            {!! $chart->container() !!} 
        </div>

    </div>

    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}
    
@endsection