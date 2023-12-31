<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DivisaoTarefa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                //  0 = Backlog
                //  1 = Doing
                //  2 = Code Review

                'classificacao' => $request->classificacao,
                //  0 = Baixa Prioridade
                //  1 = Média prioridade
                //  2 = Alta Prioridade

                'numeroChamado' => $request->numeroChamado,
                'data_conclusao_prevista' => $request->data_conclusao_prevista,
                'data_conclusao' => $request->data_conclusao
            ]);
            DB::commit();
            //resetar csrf token
            $request->session()->regenerateToken();
            return redirect()->route('boardDivisao.index', $request->divisao_id)->with([
                'type' => 'success',
                'message' => 'Tarefa cadastrada com sucesso!'
            ]);
        } catch (Exception $exception) {
            dd($exception);
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'message' => 'Erro ao cadastrar tarefa.']);
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
        $tarefa = DivisaoTarefa::findOrFail($id);
        if($tarefa->criador_id == auth()->user()->id || auth()->user()->is_admin) {
            return view('admin.divisao_tarefa.edit', compact('tarefa'));
        }else
            return redirect()->back()->with(['type' => 'error', 'message' => 'Você não tem permissão para atualizar esta tarefa.']);
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
                //  0 = Backlog
                //  1 = Doing
                //  2 = Code Review
                //  3 = Concluída

                'classificacao' => $request->classificacao,
                //  0 = Baixa Prioridade
                //  1 = Média prioridade
                //  2 = Alta Prioridade

                'numeroChamado' => $request->numeroChamado,
                'data_conclusao_prevista' => $request->data_conclusao_prevista,
                'data_conclusao' => $request->data_conclusao
            ]);
            DB::commit();
            //resetar csrf token
            $request->session()->regenerateToken();
            return redirect()->back()->with(['type' => 'success', 'message' => 'Tarefa atualizada com sucesso!']);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'message' => 'Erro ao atualizar tarefa.']);
        }
    }

    public function updateStatus($task_id)
    {
        try {
            $task = DivisaoTarefa::findOrFail($task_id);
            if($task->criador_id == auth()->user()->id || auth()->user()->is_admin) {

                $task->situacao = 3; // Assuming 3 represents the "done" status
                $task->data_conclusao = date('Y-m-d'); // Set the current date as the completion date
                $task->save();

                // Optionally, you can return a response or redirect to a specific page
                return redirect()->back()->with(['type' => 'success', 'message' => 'Tarefa concluída!']);
            }else
                return redirect()->back()->with(['type' => 'error', 'message' => 'Você não tem permissão para atualizar esta tarefa.']);
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with(['type' => 'error', 'message' => 'Erro ao atualizar status da tarefa!']);
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

    public function moveSituacao(Request $request){
        try {
            DB::rollBack();
            $tarefa = DivisaoTarefa::findOrFail($request->taskId);
            if($tarefa->criador_id == auth()->user()->id || auth()->user()->is_admin){
                $tarefa->situacao = $request->situacao;
                $tarefa->save();
                DB::commit();
                return response()->json("Situação da tarefa atualizada com sucesso!", 200);
            }else
                return redirect()->back()->with(['type' => 'error', 'message' => 'Você não tem permissão para atualizar esta tarefa.']);
        }catch (Exception $exception) {
            DB::rollBack();
            return response()->json("Erro ao atualizar situação da tarefa!", 500);
        }
    }
}
