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
Route::resource('departamento', \App\Http\Controllers\Admin\DepartamentoController::class)->except(['create', 'index']);
Route::get('departamento/index/{secretaria_id}', [\App\Http\Controllers\Admin\DepartamentoController::class, 'index'])->name('departamento.index');
Route::get('departamento/create/{secretaria_id}', [\App\Http\Controllers\Admin\DepartamentoController::class, 'create'])->name('departamento.create');

//DIVISOES
Route::resource('divisao', \App\Http\Controllers\Admin\DivisaoController::class)->except(['create', 'index']);
Route::get('divisao/index/{departamento_id}', [\App\Http\Controllers\Admin\DivisaoController::class, 'index'])->name('divisao.index');
Route::get('divisao/create/{departamento_id}', [\App\Http\Controllers\Admin\DivisaoController::class, 'create'])->name('divisao.create');

//LOTACAO DO SERVIDOR NO DEPARTAMENTO
Route::get('departamentos/{id}/servidor', [\App\Http\Controllers\Admin\DepartamentoController::class, 'createServidor'])->name('departamentos.servidor.create');
Route::resource('departamentoServidor', \App\Http\Controllers\Admin\DepartamentoServidorController::class);

//LOTACAO DO SERVIDOR NA DIVISAO
Route::get('divisao/{id}/servidor', [\App\Http\Controllers\Admin\DivisaoController::class, 'createServidor'])->name('divisao.servidor.create');
Route::resource('divisaoServidor', \App\Http\Controllers\Admin\DivisaoServidorController::class);

// SERVIDORES
Route::resource('servidores', \App\Http\Controllers\Admin\ServidorController::class);

// TAREFAS
Route::resource('tarefas', \App\Http\Controllers\Admin\TarefaController::class)->except(['create', 'index']);
Route::get('tarefa/create/{departamento_id}', [\App\Http\Controllers\Admin\TarefaController::class, 'create'])->name('tarefa.create');

//BOARD TESTE
Route::get('departamento/{departamento_id}/board', [\App\Http\Controllers\Admin\BoardController::class, 'index'])->name('board.index');

//CONTENT
Route::get('/dashboard/content', [\App\Http\Controllers\Admin\HomeController::class, 'content'])->name('dashboard.content');
