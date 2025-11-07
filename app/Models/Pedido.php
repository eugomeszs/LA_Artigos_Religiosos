<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pedido extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'data_pedido',
        'valor_total',
        'status',
        'endereco_de_entrega',
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    public function produtos(): BelongsToMany
    {
        // Define a tabela pivot e as colunas adicionais
        return $this->belongsToMany(Produto::class, 'item_pedidos', 'pedido_id', 'produto_id')
                    ->withPivot('quantidade', 'preco_unitario')
                    ->withTimestamps();
    }
}