<?php

namespace App\Charts;

use App\Models\Pedido;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class ValorTotalPorDia
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $pedidos = Pedido::select(
                DB::raw('DATE(data_pedido) as data'), 
                DB::raw('SUM(valor_total) as total') 
            )
            ->groupBy('data') 
            ->orderBy('data', 'asc') 
            ->get();

        $datas = [];
        $totais = [];

        foreach ($pedidos as $pedido) {
            $datas[] = date('d/m', strtotime($pedido->data));
            $totais[] = $pedido->total;
        }

        return $this->chart->lineChart()
            ->setTitle('Receita Diária')
            ->setSubtitle('Soma do valor total dos pedidos por dia.')
            ->addData('Valor Total (R$)', $totais)
            ->setXAxis($datas);
    }
}