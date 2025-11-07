<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Cliente;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Pedido::with('cliente');

        if ($request->has('busca')) {
            $busca = $request->input('busca');
            $query->where('id', 'like', "%{$busca}%")
                  ->orWhereHas('cliente', function ($q) use ($busca) {
                      $q->where('nome', 'like', "%{$busca}%");
                  });
        }

        $pedidos = $query->latest()->get(); 
        
        return view('pedido.pedidos', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();
        
        $dado = new Pedido();

        return view('pedido.pedidoCadastrar', compact('dado', 'clientes', 'produtos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'endereco_entrega' => 'required|string',
            'produtos' => 'required|array',
            'produtos.0.id' => 'required|exists:produtos,id', 
            'produtos.0.quantidade' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            $pedido = Pedido::create([
                'cliente_id' => $request->cliente_id,
                'data_pedido' => now(), 
                'endereco_entrega' => $request->endereco_entrega,
                'status' => 'Pendente',
                'valor_total' => 0.00, 
            ]);

            $valorTotal = 0;
            $item = $request->produtos[0];
            $produto = Produto::findOrFail($item['id']);
                
            $quantidade = $item['quantidade'];
            $precoUnitario = $produto->preco;
            $subtotal = $quantidade * $precoUnitario;
            $valorTotal += $subtotal;

            $pedido->produtos()->attach($produto->id, [
                'quantidade' => $quantidade,
                'preco_unitario' => $precoUnitario,
            ]);

            $pedido->valor_total = $valorTotal;
            $pedido->save();

            DB::commit();

            return redirect()->route('pedidos.index')->with('success', 'Pedido criado com sucesso!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erro ao criar o pedido: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        $pedido->load('cliente', 'produtos');
        return view('pedido.show', compact('pedido'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        $clientes = Cliente::all();
        $produtos = Produto::all();
        $pedido->load('produtos');
        
        $dado = $pedido;

        return view('pedido.pedidoCadastrar', compact('dado', 'clientes', 'produtos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        $request->validate([
            'status' => 'required|string|max:50',
            'endereco_entrega' => 'required|string',
        ]);

        $pedido->update($request->only('status', 'endereco_entrega'));

        return redirect()->route('pedidos.index')->with('success', 'Pedido atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return redirect()->route('pedidos.index')->with('success', 'Pedido deletado com sucesso!');
    }
}