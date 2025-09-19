<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Certifique-se de que a tabela de categorias não está vazia
        $categoriaTerco = Categoria::where('nome', 'Terços')->first();
        $categoriaBiblia = Categoria::where('nome', 'Bíblias')->first();
        $categoriaImagens = Categoria::where('nome', 'Imagens de Santos')->first();

        if ($categoriaTerco && $categoriaBiblia && $categoriaImagens) {
            $produtos = [
                [
                    'nome' => 'Terço de Madeira',
                    'descricao' => 'Terço artesanal feito de madeira com cordão reforçado.',
                    'preco' => 25.50,
                    'categoria_id' => $categoriaTerco->id,
                ],
                [
                    'nome' => 'Bíblia Sagrada Edição de Bolso',
                    'descricao' => 'Bíblia com capa dura e tamanho ideal para carregar.',
                    'preco' => 50.00,
                    'categoria_id' => $categoriaBiblia->id,
                ],
                [
                    'nome' => 'Imagem de Nossa Senhora Aparecida',
                    'descricao' => 'Imagem de gesso pintada à mão, 20cm de altura.',
                    'preco' => 85.90,
                    'categoria_id' => $categoriaImagens->id,
                ],
                [
                    'nome' => 'Terço de Contas de Cristal',
                    'descricao' => 'Terço elegante com contas de cristal e crucifixo de metal.',
                    'preco' => 45.00,
                    'categoria_id' => $categoriaTerco->id,
                ],
            ];

            foreach ($produtos as $produto) {
                Produto::create($produto);
            }
        } else {
            // Opcional: Adicionar uma mensagem de aviso caso as categorias não sejam encontradas.
            echo "As categorias 'Terços', 'Bíblias' ou 'Imagens de Santos' não foram encontradas. Execute o CategoriaSeeder primeiro.\n";
        }
    }
}