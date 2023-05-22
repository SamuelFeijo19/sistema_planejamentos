<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DivisaoTarefa;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($divisao_id)
    {
        //
        return view('admin.divisao_tarefa.create', compact('divisao_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $tarefa = DivisaoTarefa::create([
                'divisao_id' => $request->divisao_id,
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
        $tarefa = DivisaoTarefa::findOrFail($id);
        return view('admin.divisao_tarefa.edit', compact('tarefa'));
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
            $tarefa = DivisaoTarefa::findOrFail($id);
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
            $tarefa = DivisaoTarefa::findOrFail($id);
            $tarefa->delete();
            DB::commit();
            return response()->json(['msg' => 'tarefa excluída com sucesso!'], 200);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['msg' => 'Erro ao excluir tarefa!'], 500);
        }
    }
}
