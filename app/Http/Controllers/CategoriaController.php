<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Charts\ProdutoQtdCategoria; // Importe a classe do seu gráfico

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $query = Categoria::query();

        if ($request->has('busca')) {
            $busca = $request->input('busca');
            $query->where('nome', 'like', "%{$busca}%");
        }

        $categorias = $query->get();

        return view('categoria.categorias', compact('categorias'));
    }

    public function create()
    {
        $dado = new Categoria();
        return view('categoria.categoriaCadastrar', compact('dado'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:categorias',
        ]);

        Categoria::create($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoria cadastrada!');
    }

    public function edit(Categoria $categoria)
    {
        $dado = $categoria;
        return view('categoria.categoriaCadastrar', compact('dado'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nome' => 'required|string|max:255|unique:categorias,nome,' . $categoria->id,
        ]);

        $categoria->update($request->all());

        return redirect()->route('categorias.index')->with('success', 'Categoria atualizada!');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoria removida!');
    }

    public function produtos()
    {
        
    }

    public function chart(ProdutoQtdCategoria $chart){

        return view('categoria.chartProdutoQtdCategoria', ['chart' => $chart->build()]);
    }

}