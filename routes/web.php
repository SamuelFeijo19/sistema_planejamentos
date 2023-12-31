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

//ROTAS LIVRES
Route::get('/', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::get('/login', '\App\Http\Controllers\LoginController@index')->name('login');
Route::post('/login', '\App\Http\Controllers\LoginController@authenticate')->name('login');
Route::resource('/registro', \App\Http\Controllers\Usuario\RegistroController::class)->only(['create', 'store']);
Route::get('/sair', '\App\Http\Controllers\LoginController@sair')->name('sair');
Route::get('recuperar-senha', [\App\Http\Controllers\RecuperarSenhaController::class, 'create'])->name('recuperar-senha');
Route::post('recuperar-senha', [\App\Http\Controllers\RecuperarSenhaController::class, 'submitForgetPasswordForm'])->name('recuperar-senha');
Route::get('recebido-resetar-senha/{token}', [\App\Http\Controllers\RecuperarSenhaController::class, 'resetPassword'])->name('mail-resetar-senha');
Route::post('resetar-senha', [\App\Http\Controllers\RecuperarSenhaController::class, 'confirmResetPassword'])->name('resetar-senha');

//ROTAS QUE SÓ PODEM SER ACESSADAS APÓS AUTENTICAÇÃO
Route::prefix('')->middleware('autenticacao')->group(function () {

    //ROTAS QUE SÓ PODEM SER ACESSADAS POR ADMINISTRADORES DO SISTEMA
    Route::middleware('is.admin')->group(function () {
        // SECRETARIAS
        Route::resource('secretarias', \App\Http\Controllers\Admin\SecretariaController::class);

        //DEPARTAMENTOS
        Route::resource('departamento', \App\Http\Controllers\Admin\DepartamentoController::class)->except(['create', 'show', 'index']);
        Route::get('departamento/show/{secretaria_id}', [\App\Http\Controllers\Admin\DepartamentoController::class, 'show'])->name('departamento.show');
        Route::get('departamento/create/{secretaria_id}', [\App\Http\Controllers\Admin\DepartamentoController::class, 'create'])->name('departamento.create');

        //DIVISOES
        Route::resource('divisao', \App\Http\Controllers\Admin\DivisaoController::class)->except(['create', 'show', 'index']);
        Route::get('divisao/create/{departamento_id}', [\App\Http\Controllers\Admin\DivisaoController::class, 'create'])->name('divisao.create');

        Route::resource('departamentoServidor', \App\Http\Controllers\Admin\DepartamentoServidorController::class)->except(['create', 'show']);

        Route::resource('divisaoServidor', \App\Http\Controllers\Admin\DivisaoServidorController::class)->except(['create', 'show']);

        // TAREFAS DEPARTAMENTO
        Route::get('tarefasDepartamento/{tarefa_id}/destroy', [\App\Http\Controllers\Admin\DepartamentoTarefaController::class, 'destroy'])->name('tarefasDepartamento.destroy');

        // TAREFAS DIVISAO
        Route::get('tarefaDivisao/{tarefa_id}/destroy', [\App\Http\Controllers\Admin\DivisaoTarefaController::class, 'destroy'])->name('tarefasDivisao.destroy');

        // SERVIDORES
        Route::resource('servidores', \App\Http\Controllers\Admin\ServidorController::class);
    });//FIM DAS ROTAS QUE SÓ PODEM SER ACESSADAS POR ADMINISTRADORES DO SISTEMA


    //ROTAS LIVRES PARA USUÁRIO NÃO ADM
    //PERFIL
    Route::resource('perfil', \App\Http\Controllers\Admin\PerfilController::class);

    //ROTAS QUE SÓ PODEM SER ACESADAS PELO CHEFE DO DEPARTAMENTO E PELO ADM DO SISTEMA
    Route::middleware('adminDpt')->group(function () {
        //LOTACAO DO SERVIDOR NO DEPARTAMENTO
        Route::get('/departamentoServidor/create/{departamento_id}', [\App\Http\Controllers\Admin\DepartamentoServidorController::class, 'create'])->name('departamentoServidor.create');
    });

    //ROTAS QUE SÓ PODEM SER ACESSADAS PELO CHEFE DA DIVISÃO, CHEFE DO DEPARTAMENTO QUE A DIVISAO ESTA LOTADA E PELO ADM DO SISTEMA
    Route::middleware(['adminDivisao'])->group(function () {
        Route::get('/DivisaoServidor/create/{divisao_id}', [\App\Http\Controllers\Admin\DivisaoServidorController::class, 'create'])->name('divisaoServidor.create');
    });

    //DEPARTAMENTOS
    Route::get('departamento/index', [\App\Http\Controllers\Admin\DepartamentoController::class, 'index'])->name('departamento.index');

    //TAREFAS DO DEPARTAMENTOS
    Route::get('tarefaDepartamento/create/{tarefa_id}', [\App\Http\Controllers\Admin\DepartamentoTarefaController::class, 'create'])->name('tarefasDepartamento.create');
    Route::post('tarefaDepartamento/store', [\App\Http\Controllers\Admin\DepartamentoTarefaController::class, 'store'])->name('tarefasDepartamento.store');
    Route::get('tarefasDepartamento/{tarefa_id}/edit', [\App\Http\Controllers\Admin\DepartamentoTarefaController::class, 'edit'])->name('tarefasDepartamento.edit');
    Route::PUT('tarefasDepartamento/{tarefa_id}/update', [\App\Http\Controllers\Admin\DepartamentoTarefaController::class, 'update'])->name('tarefasDepartamento.update');

    //DIVISOES
    Route::get('divisao/index', [\App\Http\Controllers\Admin\DivisaoController::class, 'index'])->name('divisao.index');

    //TAREFAS DAS DIVISOES
    Route::get('tarefaDivisao/create/{tarefa_id}', [\App\Http\Controllers\Admin\DivisaoTarefaController::class, 'create'])->name('tarefaDivisao.create');
    Route::post('tarefaDivisao/store', [\App\Http\Controllers\Admin\DivisaoTarefaController::class, 'store'])->name('tarefasDivisao.store');
    Route::get('tarefaDivisao/{tarefa_id}/edit', [\App\Http\Controllers\Admin\DivisaoTarefaController::class, 'edit'])->name('tarefasDivisao.edit');
    Route::PUT('tarefaDivisao/{tarefa_id}/update', [\App\Http\Controllers\Admin\DivisaoTarefaController::class, 'update'])->name('tarefasDivisao.update');

    //SERVIDORES LOTADOS NOS DEPARTAMENTOS
    Route::get('/departamentoServidor/show/{departamento_id}', [\App\Http\Controllers\Admin\DepartamentoServidorController::class, 'show'])->name('departamentoServidor.show');

    //SERVIDORES LOTADOS NAS DIVISOES
    Route::get('/divisaoServidor/show/{divisao_id}', [\App\Http\Controllers\Admin\DivisaoServidorController::class, 'show'])->name('divisaoServidor.show');

    //DIVISOES LOTADAS NOS DEPARTAMENTOS
    Route::get('divisao/show/{departamento_id}', [\App\Http\Controllers\Admin\DivisaoController::class, 'show'])->name('divisao.show');

    //BOARD DEPARTAMENTO

    Route::get('departamento/{departamento_id}/board', [\App\Http\Controllers\Admin\BoardController::class, 'index'])->name('boardDepartamento.index');

    //BOARD DIVISAO
    Route::get('divisao/{divisao_id}/board', [\App\Http\Controllers\Admin\BoardDivisaoController::class, 'index'])->name('boardDivisao.index');

    //CONTENT
    Route::get('/dashboard/content', [\App\Http\Controllers\Admin\HomeController::class, 'content'])->name('dashboard.content');

    //EXIBIR DETALHES DAS TAREFAS
    Route::get('taskDepartamento/{task_id}/details', [\App\Http\Controllers\Admin\BoardController::class, 'getTaskDetails'])->name('taskDepartamento.details');
    Route::get('taskDivisao/{task_id}/details', [\App\Http\Controllers\Admin\BoardDivisaoController::class, 'getTaskDetails'])->name('taskDivisao.details');

    //MOVER CARD PELO BOARD
    Route::post('taskDepartamento/move-situacao', [\App\Http\Controllers\Admin\DepartamentoTarefaController::class, 'moveSituacao'])->name('task.moveSituacao');
    Route::post('task/move-situacao', [\App\Http\Controllers\Admin\DivisaoTarefaController::class, 'moveSituacao'])->name('task.moveSituacaoDivisao');

    Route::get('/alternarQuadroDepartamento', [\App\Http\Controllers\Admin\BoardController::class, 'alternarQuadroDpt'])->name('quadro.alternar.departamento');
    Route::get('/alternarQuadroDivisao', [\App\Http\Controllers\Admin\BoardDivisaoController::class, 'alternarQuadroDiv'])->name('quadro.alternar.divisao');

    //FECHAR TAREFA DO DEPARTAMENTO
    Route::get('taskDepartamento/{task_id}/update-status', [\App\Http\Controllers\Admin\DepartamentoTarefaController::class, 'updateStatus'])->name('taskDepartamento.updateStatus');

    //FECHAR TAREFA DA DIVISAO
    Route::get('taskDivisao/{task_id}/update-status', [\App\Http\Controllers\Admin\DivisaoTarefaController::class, 'updateStatus'])->name('taskDivisao.updateStatus');

    Route::get('/departamentos/by/secretaria/{secretaria}', [\App\Http\Controllers\Admin\DivisaoController::class, 'getBySecretaria'])->name('departamentos.porSecretaria');

    //NOVA ROTA PARA RELATORIOS
    Route::get('/departamento/{departamento_id}/relatorio', [\App\Http\Controllers\Admin\RelatorioController::class, 'relatorioDepartamento'])->name('departamento.relatorio');
    Route::get('/divisao/{divisao_id}/relatorio', [\App\Http\Controllers\Admin\RelatorioController::class, 'relatorioDivisao'])->name('divisao.relatorio');
});
