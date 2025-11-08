<?php

namespace App\Http\Controllers;

use App\Models\Fornecedor;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Fornecedor::query();

        if ($request->has('busca')) {
            $busca = $request->input('busca');
            $query->where('nome', 'like', "%{$busca}%")
                  ->orWhere('cnpj', 'like', "%{$busca}%")
                  ->orWhere('motivo', 'like', "%{$busca}%"); // Corrigido de 'motivo'
        }

        $fornecedores = $query->get(); // Corrigido de $fornecedor
        
        return view('fornecedor.fornecedores', compact('fornecedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dado = new Fornecedor();
        
        return view('fornecedor.fornecedorCadastrar', compact('dado'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'cnpj' => 'nullable|string|max:18|unique:fornecedores,cnpj',
            'motivo' => 'nullable|string|max:150', 
            'email' => 'nullable|email|max:100',
            'telefone' => 'nullable|string|max:20',
        ]);

        Fornecedor::create($request->all()); 

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Fornecedor $fornecedor)
    {
        return view('fornecedor.show', compact('fornecedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Fornecedor $fornecedor)
    {
        $dado = $fornecedor;

        return view('fornecedor.fornecedorCadastrar', compact('dado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Fornecedor $fornecedor)
    {
        $request->validate([
            'nome' => 'required|string',
            'cnpj' => 'nullable|string|max:18|unique:fornecedores,cnpj,' . $fornecedor->id,
            'motivo' => 'nullable|string|max:150', 
            'email' => 'nullable|email|max:100',
            'telefone' => 'nullable|string|max:20',
        ]);

        $fornecedor->update($request->all());

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fornecedor $fornecedor)
    {
        $fornecedor->delete();

        return redirect()->route('fornecedores.index')->with('success', 'Fornecedor deletado com sucesso!');
    }
}