<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'motivo',
        'cnpj',
        'email',
        'telefone',
    ];

    // Opcional: Relacionamento, se você adicionar 'fornecedor_id' na tabela 'produtos'
    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}