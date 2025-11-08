<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\PedidoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui é onde você pode registrar as rotas web para sua aplicação. Estas
| rotas são carregadas pelo RouteServiceProvider e todas elas serão
| atribuídas ao grupo de middleware "web". Faça algo ótimo!
|
*/

/*Route::resource('cliente', ClienteController::class 'clientes');*/

Route::resource('cliente', ClienteController::class);
Route::resource('clientes', ClienteController::class);
Route::resource('categorias', CategoriaController::class)->except(['show']);
Route::get('/categorias/chart', [CategoriaController::class, 'chart'])->name('categorias.chart');
Route::get('/categorias/report', [CategoriaController::class, 'chart'])->name('categorias.report');
Route::resource('produtos', ProdutoController::class);
Route::resource('fornecedores', FornecedorController::class);
Route::resource('pedidos', PedidoController::class); 
Route::get('/pedidos/chart', [PedidoController::class, 'chartValor'])->name('pedidos.chartValor');
Route::get('/pedidos/report', [PedidoController::class, 'gerarReport'])->name('pedidos.report');