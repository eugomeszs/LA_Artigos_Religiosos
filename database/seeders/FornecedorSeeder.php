<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fornecedor;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fornecedores = [
            [
                'nome' => 'Divina Luz Distribuidora',
                'motivo' => 'Divina Luz Artigos Religiosos LTDA',
                'cnpj' => '11.222.333/0001-44',
                'email' => 'contato@divinaluz.com',
                'telefone' => '(11) 98765-4321',
            ],
            [
                'nome' => 'Paz e Fé Suprimentos',
                'motivo' => 'Paz e Fé S/A',
                'cnpj' => '44.555.666/0001-77',
                'email' => 'vendas@pazefe.com.br',
                'telefone' => '(21) 12345-6789',
            ],
            [
                'nome' => 'Biblia Fácil Atacado',
                'motivo' => 'B.F. Comércio de Livros',
                'cnpj' => '77.888.999/0001-00',
                'email' => 'compras@bibliafacil.com',
                'telefone' => '(31) 55555-5555',
            ],
        ];

        Fornecedor::upsert($fornecedores, ['cnpj'], ['nome', 'email', 'telefone']);
    }
}