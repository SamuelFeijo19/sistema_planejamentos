<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\DivisaoTarefa;
use App\Models\Servidor;
use App\Models\Tarefa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivisaoTarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $divisao_id)
    {
        $tarefas = DivisaoTarefa::all();

        $tarefas->where('divisao_id', $divisao_id);

        return view('admin.tarefas.index', compact('tarefas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($departamento_id)
    {
        //
        return view('admin.tarefa.create', compact('departamento_id'));
    }

//    public function createServidor($id)
//    {
//        //BUSCA SOMENTE PARTICIPANTES QUE NÃO FORAM CADASTRADOS NO MESMO DEPARTAMENTO BUSCADO.
//        $servidores = Servidor::whereNotIn('id', function ($query) use ($id) {
//            $query->select('servidor_id')->from('departamento_servidor')->where('departamento_id', $id);
//        })->get();
//
//        $departamento = Departamento::findOrFail($id);
//
//        return view('admin.departamento.servidor', compact('servidores', 'departamento'));
//    }
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        try {
            DB::beginTransaction();
            $tarefa = Tarefa::create([
                'departamento_id' => $request->departamento_id,
                'nomeTarefa' => mb_strtoupper($request->nomeTarefa),
                'criador_id' => auth()->user()->id,
                'descricao' => $request->descricao,
                'situacao' => $request->situacao,
                'classificacao' => $request->classificacao
            ]);
            DB::commit();
            //resetar csrf token
            $request->session()->regenerateToken();
            return "Tarefa Cadastrada!";
        } catch (Exception $exception) {
            dd($exception);
            DB::rollBack();
            return "Erro ao cadastrar tarefa!";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $departamento = Departamento::findOrFail($id);
        return view('admin.departamento.show', compact('departamento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $tarefa = Tarefa::findOrFail($id);
        return view('admin.tarefa.edit', compact('tarefa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        try {
            DB::beginTransaction();
            $tarefa = Tarefa::findOrFail($id);
            $tarefa->update([
                'nomeTarefa' => mb_strtoupper($request->nomeTarefa),
                'descricao' => $request->descricao,
                'situacao' => $request->situacao,
                'classificacao' => $request->classificacao
            ]);
            DB::commit();
            //resetar csrf token
            $request->session()->regenerateToken();
            return "tarefa atualiada com sucesso";
        } catch (Exception $exception) {
            DB::rollBack();
            return "erro ao atualizar tarefa!";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            DB::beginTransaction();
            $departamento = Departamento::findOrFail($id);
            $departamento->delete();
            DB::commit();
            return response()->json(['msg' => 'Departamento excluído com sucesso!'], 200);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['msg' => 'Erro ao excluir departamento!'], 500);
        }
    }
}
