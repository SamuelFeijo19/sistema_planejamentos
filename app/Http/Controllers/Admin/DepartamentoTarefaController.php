<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\DepartamentoTarefa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartamentoTarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($departamento_id)
    {
        return view('admin.departamento_tarefa.create', compact('departamento_id'));
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
            $tarefa = DepartamentoTarefa::create([
                'departamento_id' => $request->departamento_id,
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

                'numeroChamado' => $request->numeroChamado
            ]);
            DB::commit();
            //resetar csrf token
            $request->session()->regenerateToken();
            return redirect()->back()->with(['type' => 'success', 'message' => 'Tarefa Cadastrada!']);
        } catch (Exception $exception) {
            dd($exception);
            DB::rollBack();
            return redirect()->back()->with(['type' => 'success', 'message' => 'Erro ao Cadastrar Tarefa!']);
        }
    }

    public function updateStatus($task_id)
    {
        try {
            $task = DepartamentoTarefa::findOrFail($task_id);

            // Check if the authenticated user is the creator of the task
            if ($task->criador_id !== auth()->user()->id) {
                return redirect()->back()->with(['type' => 'error', 'message' => 'Você não tem permissão para atualizar esta tarefa.']);
            }

            $task->situacao = 3; // Assuming 3 represents the "done" status
            $task->save();

            // Optionally, you can return a response or redirect to a specific page
            return redirect()->back()->with(['type' => 'success', 'message' => 'Tarefa concluída!']);
        } catch (Exception $exception) {
            DB::rollBack();

            return redirect()->back()->with(['type' => 'error', 'message' => 'Erro ao atualizar status da tarefa!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($tarefa_id)
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
        $tarefa = DepartamentoTarefa::findOrFail($id);
        return view('admin.departamento_tarefa.edit', compact('tarefa'));
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
            $tarefa = DepartamentoTarefa::findOrFail($id);
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

                'numeroChamado' => $request->numeroChamado
            ]);
            DB::commit();
            //resetar csrf token
            $request->session()->regenerateToken();
            return redirect()->back()->with(['type' => 'success', 'message' => 'Tarefa atualizada com sucesso!']);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'message' => 'Erro ao atualizar tarefa!']);
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
            return redirect()->back()->with(['type' => 'success', 'message' => 'Tarefa excluída com sucesso!']);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'message' => 'Erro ao excluir tarefa!']);
        }
    }

    public function moveSituacao(Request $request){
        try {
            DB::rollBack();
            $tarefa = DepartamentoTarefa::findOrFail($request->taskId);
            $tarefa->situacao = $request->situacao;
            $tarefa->save();
            DB::commit();
            return response()->json("Situação da tarefa atualizada com sucesso!", 200);
        }catch (Exception $exception) {
            DB::rollBack();
            return response()->json("Erro ao atualizar situação da tarefa!", 500);
        }
    }
}
