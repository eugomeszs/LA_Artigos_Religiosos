<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['nome' => 'Terços'],
            ['nome' => 'Bíblias'],
            ['nome' => 'Imagens de Santos'],
            ['nome' => 'Livros Religiosos'],
            ['nome' => 'Ícones'],
            ['nome' => 'Velas e Incensos'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}


// \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',