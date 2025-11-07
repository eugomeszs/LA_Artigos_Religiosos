<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Produto;

class PedidoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();
        $statuses = ['Pendente', 'Em Separação', 'Enviado', 'Concluído'];

        // Só executa se houver clientes e produtos para ligar
        if ($clientes->isEmpty() || $produtos->isEmpty()) {
            return;
        }

        for ($i = 0; $i < 5; $i++) {
            $cliente = $clientes->random();
            $dataPedido = now()->subDays(rand(1, 30));
            $status = $statuses[array_rand($statuses)];
            $numProdutos = rand(1, 4);

            $pedido = Pedido::create([
                'cliente_id' => $cliente->id,
                'data_pedido' => $dataPedido,
                'valor_total' => 0.00,
                'status' => $status,
                'endereco_de_entrega' => "Rua Fictícia, {$i}, Cidade Teste, 12345-678",
            ]);

            $total = 0;
            $items = $produtos->random($numProdutos);

            foreach ($items as $produto) {
                $quantidade = rand(1, 3);
                $precoUnitario = $produto->preco;
                $subtotal = $quantidade * $precoUnitario;
                $total += $subtotal;

                $pedido->produtos()->attach($produto->id, [
                    'quantidade' => $quantidade,
                    'preco_unitario' => $precoUnitario,
                ]);
            }

            $pedido->valor_total = $total;
            $pedido->save();
        }
    }
}