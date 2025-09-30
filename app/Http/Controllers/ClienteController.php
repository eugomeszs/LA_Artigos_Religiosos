<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClienteRequest;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Categoria;

class ClienteController extends Controller
{
    public function index(Request $request)
    {
        $query = Cliente::query();

        if ($request->has('busca')) {
            $busca = $request->input('busca');
            $query->where('nome', 'like', "%{$busca}%")
                  ->orWhere('cpf', 'like', "%{$busca}%")
                  ->orWhere('email', 'like', "%{$busca}%");
        }

        $clientes = $query->get();

        return view('cliente.clientes', compact('clientes'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $dado = new Cliente();
        return view('cliente.clienteCadastrar', compact('dado', 'categorias'));
    }

    public function store(StoreClienteRequest $request)
    {
        $dadosValidados = $request->validated();

        if ($request->hasFile('imagem')) {
            $caminhoImagem = $request->file('imagem')->store('public/clientes');
            $dadosValidados['imagem'] = str_replace('public/', '', $caminhoImagem);
        }

        Cliente::create($dadosValidados);

        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado!');
    }

    public function edit(Cliente $cliente)
    {
        $categorias = Categoria::all();
        $dado = $cliente;
        return view('cliente.clienteCadastrar', compact('dado', 'categorias'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|max:14|unique:clientes,cpf,' . $cliente->id,
            'email' => 'nullable|string|max:20',
        ]);

        $cliente->update($request->all());

        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado!');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente removido!');
    }

    public function show($id)
    {
        $cliente = Cliente::FindOrFail($id);
        return view('cliente.show', compact('cliente'));
    }
}