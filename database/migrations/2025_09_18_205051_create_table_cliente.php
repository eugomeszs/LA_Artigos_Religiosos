<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    // database/migrations/2025_09_18_205051_create_table_cliente.php

public function up(): void
{
    Schema::create('clientes', function (Blueprint $table) {
        $table->id('id');
        $table->string('nome');
        $table->string('email')->nullable();
        $table->string('cpf')->unique();
        
        $table->foreignId('categoria_id')
              ->nullable()
              ->constrained('categorias')
              ->onDelete('set null');
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};