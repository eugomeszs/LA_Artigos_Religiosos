<?php

namespace App\Charts;

use App\Models\Categoria;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class ProdutoQtdCategoria
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $categorias = Categoria::withCount('produtos')
            ->having('produtos_count', '>', 0) 
            ->orderBy('produtos_count', 'desc') 
            ->get();

        $qtdProdutos = []; 
        $nomeCategorias = [];

        foreach ($categorias as $categoria) {
            $qtdProdutos[] = $categoria->produtos_count; 
            $nomeCategorias[] = $categoria->nome; 	
        }


        return $this->chart->barChart()
            ->setTitle('Distribuição dos Produtos por Categoria')
            ->setSubtitle('Contagem dos artigos religiosos em estoque')
            ->addData('Produtos', $qtdProdutos) 
            ->setXAxis($nomeCategorias);
    }
}