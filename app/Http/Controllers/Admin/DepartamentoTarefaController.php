<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\DepartamentoTarefa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartamentoTarefaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $departamento_id)
    {
        //
    }

    public function dadosTarefas()
    {
//        $tarefas = DepartamentoTarefa::select('situacao')
//            ->whereNotNull('departamento_id')
//            ->get();
        // Obtém o usuário logado
        $user = Auth::user();

        // Obtém o departamento relacionado ao usuário
        $departamento = $user->servidor->lotacaoDepartamento->first()->departamento;

        // Filtra as tarefas com base no departamento
        $tarefas = DepartamentoTarefa::select('situacao')
            ->where('departamento_id', $departamento->id)
            ->whereNotNull('departamento_id')
            ->get();

        $labels = ['Backlog', 'Doing', 'Code Review'];
        $values = [
            $tarefas->where('situacao', 0)->count(),
            $tarefas->where('situacao', 1)->count(),
            $tarefas->where('situacao', 2)->count()
        ];
        $colors = ['#ff6384', '#ffce56', '#1cc88a'];

        $data = [
            'labels' => $labels,
            'values' => $values,
            'colors' => $colors
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($departamento_id)
    {
        return view('admin.tarefa.create', compact('departamento_id'));
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
        $tarefa = DepartamentoTarefa::findOrFail($id);
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
            $tarefa = DepartamentoTarefa::findOrFail($id);
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
            return response()->json(['msg' => 'Tarefa excluída com sucesso!'], 200);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['msg' => 'Erro ao excluir Tarefa!'], 500);
        }
    }
}
