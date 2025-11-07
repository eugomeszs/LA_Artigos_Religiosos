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
            $query->where('nome_fantasia', 'like', "%{$busca}%")
                  ->orWhere('cnpj', 'like', "%{$busca}%")
                  ->orWhere('razao_social', 'like', "%{$busca}%");
        }

        $fornecedores = $query->get();
        
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
            'nome_fantasia' => 'required|string|max:100',
            'cnpj' => 'nullable|string|max:18|unique:fornecedors,cnpj',
            'razao_social' => 'nullable|string|max:150',
            'email_contato' => 'nullable|email|max:100',
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
            'nome_fantasia' => 'required|string|max:100',
            'cnpj' => 'nullable|string|max:18|unique:fornecedors,cnpj,' . $fornecedor->id,
            'razao_social' => 'nullable|string|max:150',
            'email_contato' => 'nullable|email|max:100',
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
