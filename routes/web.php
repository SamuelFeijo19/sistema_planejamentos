<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');


Route::get('/login', '\App\Http\Controllers\LoginController@index')->name('login');
Route::post('/login', '\App\Http\Controllers\LoginController@authenticate')->name('login');
Route::get('/sair', '\App\Http\Controllers\LoginController@sair')->name('sair');
Route::resource('/registro', \App\Http\Controllers\Usuario\RegistroController::class)->only(['create', 'store']);

Route::get('recuperar-senha', [\App\Http\Controllers\RecuperarSenhaController::class, 'create'])->name('recuperar-senha');
Route::post('recuperar-senha', [\App\Http\Controllers\RecuperarSenhaController::class, 'submitForgetPasswordForm'])->name('recuperar-senha');
Route::get('recebido-resetar-senha/{token}', [\App\Http\Controllers\RecuperarSenhaController::class, 'resetPassword'])->name('mail-resetar-senha');
Route::post('resetar-senha', [\App\Http\Controllers\RecuperarSenhaController::class, 'confirmResetPassword'])->name('resetar-senha');

// SECRETARIAS
Route::resource('secretarias', \App\Http\Controllers\Admin\SecretariaController::class);

//DEPARTAMENTOS
Route::resource('departamento', \App\Http\Controllers\Admin\DepartamentoController::class)->except(['create', 'show']);
Route::get('departamento/show/{secretaria_id}', [\App\Http\Controllers\Admin\DepartamentoController::class, 'show'])->name('departamento.show');
Route::get('departamento/create/{secretaria_id}', [\App\Http\Controllers\Admin\DepartamentoController::class, 'create'])->name('departamento.create');

//DIVISOES
Route::resource('divisao', \App\Http\Controllers\Admin\DivisaoController::class)->except(['create', 'show']);
Route::get('divisao/show/{departamento_id}', [\App\Http\Controllers\Admin\DivisaoController::class, 'show'])->name('divisao.show');
Route::get('divisao/create/{departamento_id}', [\App\Http\Controllers\Admin\DivisaoController::class, 'create'])->name('divisao.create');

//LOTACAO DO SERVIDOR NO DEPARTAMENTO
Route::get('departamentos/{id}/servidor', [\App\Http\Controllers\Admin\DepartamentoController::class, 'createServidor'])->name('departamentos.servidor.create');

Route::resource('departamentoServidor', \App\Http\Controllers\Admin\DepartamentoServidorController::class)->except(['create']);;
Route::get('/departamentoServidor/create/{departamento_id}', [\App\Http\Controllers\Admin\DepartamentoServidorController::class, 'create'])->name('departamentoServidor.create');

//LOTACAO DO SERVIDOR NA DIVISAO
Route::get('divisao/{id}/servidor', [\App\Http\Controllers\Admin\DivisaoController::class, 'createServidor'])->name('divisao.servidor.create');

Route::resource('divisaoServidor', \App\Http\Controllers\Admin\DivisaoServidorController::class)->except(['create']);
Route::get('/DivisaoServidor/create/{divisao_id}', [\App\Http\Controllers\Admin\DivisaoServidorController::class, 'create'])->name('divisaoServidor.create');

// SERVIDORES
Route::resource('servidores', \App\Http\Controllers\Admin\ServidorController::class);

// TAREFAS DEPARTAMENTO
Route::resource('tarefas', \App\Http\Controllers\Admin\DepartamentoTarefaController::class)->except(['create', 'index']);
Route::get('tarefa/create/{departamento_id}', [\App\Http\Controllers\Admin\DepartamentoTarefaController::class, 'create'])->name('tarefa.create');

// TAREFAS DIVISAO
Route::resource('tarefasDivisao', \App\Http\Controllers\Admin\DivisaoTarefaController::class)->except(['create', 'index']);
Route::get('tarefaDivisao/create/{divisao_id}', [\App\Http\Controllers\Admin\DivisaoTarefaController::class, 'create'])->name('tarefaDivisao.create');

//BOARD DEPARTAMENTO
Route::get('departamento/{departamento_id}/board', [\App\Http\Controllers\Admin\BoardController::class, 'index'])->name('board.index');

//BOARD DIVISAO
Route::get('divisao/{divisao_id}/board', [\App\Http\Controllers\Admin\BoardDivisaoController::class, 'index'])->name('boardDivisao.index');

//CONTENT
Route::get('/dashboard/content', [\App\Http\Controllers\Admin\HomeController::class, 'content'])->name('dashboard.content');

//GRAFICO
Route::get('/dados-tarefas', [\App\Http\Controllers\Admin\DepartamentoTarefaController::class, 'dadosTarefas'])->name('dados-tarefas');

