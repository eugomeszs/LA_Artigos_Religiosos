<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nome' => 'Terços',
                'religiao' => 'Católica',
                'material' => 'Madeira/Metal/Vidro'
            ],
            [
                'nome' => 'Bíblias',
                'religiao' => 'Cristã',
                'material' => 'Papel/Couro'
            ],
            [
                'nome' => 'Imagens de Santos',
                'religiao' => 'Católica',
                'material' => 'Resina/Gesso'
            ],
            [
                'nome' => 'Livros Religiosos',
                'religiao' => 'Variável',
                'material' => 'Papel'
            ],
            [
                'nome' => 'Ícones Religiosos',
                'religiao' => 'Ortodoxa',
                'material' => 'Madeira'
            ],
            [
                'nome' => 'Velas e Incensos',
                'religiao' => 'Variável',
                'material' => 'Cera/Resina'
            ],
        ];

        Categoria::upsert(
            $categorias,
            ['nome'], 
            ['religiao', 'material'] 
        );
    }
}