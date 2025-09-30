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
        $categoriaCliente = Categoria::first();

        $clientes = [
            [
                'nome' => 'Larissa Burin Dalla Riva',
                'cpf' => '123.456.186-01',
                'email' => 'larissa@gmail.com',
                'categoria_id' => $categoriaCliente ? $categoriaCliente->id : null,
            ],
            [
                'nome' => 'Keyrisson Sirino Gomes Gonçalves',
                'cpf' => '987.654.321-02',
                'email' => 'keyrisson@gmail.com',
                'categoria_id' => $categoriaCliente ? $categoriaCliente->id : null,
            ],
            [
                'nome' => 'Adilson Gonçalves',
                'cpf' => '066.186.599-59',
                'email' => 'adilson@gmail.com',
                'categoria_id' => $categoriaCliente ? $categoriaCliente->id : null,
            ],
            [
                'nome' => 'Alvaro Forceline Guaragni',
                'cpf' => '066.186.589-59',
                'email' => 'alvaro@gmail.com',
                'categoria_id' => $categoriaCliente ? $categoriaCliente->id : null,
            ],
        ];

        foreach ($clientes as $cliente) {
            Cliente::create($cliente);
        }
    }
}