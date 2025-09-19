<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assumindo que você tem uma categoria para associar aos clientes, se não tiver pode deixar o categoria_id como null
        $categoriaCliente = Categoria::first();

        $clientes = [
            [
                'nome' => 'Larissa Burin Dalla Riva',
                'cpf' => '123.456.186-01',
                'telefone' => '49995895968',
                'categoria_id' => $categoriaCliente ? $categoriaCliente->id : null,
            ],
            [
                'nome' => 'Keyrisson Sirino Gomes Gonçalves',
                'cpf' => '987.654.321-02',
                'telefone' => '47988887777',
                'categoria_id' => $categoriaCliente ? $categoriaCliente->id : null,
            ],
            [
                'nome' => 'Adilson Gonçalves',
                'cpf' => '066.186.599-59',
                'telefone' => '49999483324',
                'categoria_id' => $categoriaCliente ? $categoriaCliente->id : null,
            ],
            [
                'nome' => 'Alvaro Forceline Guaragni',
                'cpf' => '066.186.589-59',
                'telefone' => '49999486723',
                'categoria_id' => $categoriaCliente ? $categoriaCliente->id : null,
            ],
            [
                'nome' => 'Adilson Gonçalves',
                'cpf' => '038.159.587-31',
                'telefone' => '49998180872',
                'categoria_id' => $categoriaCliente ? $categoriaCliente->id : null,
            ],
        ];

        foreach ($clientes as $cliente) {
            Cliente::create($cliente);
        }
    }
}