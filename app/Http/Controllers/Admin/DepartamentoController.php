<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartamentoRequest;
use App\Models\Departamento;
use App\Models\DepartamentoServidor;
use App\Models\DepartamentoTarefa;
use App\Models\Secretaria;
use App\Models\Servidor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $secretaria_id
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departamentosQuery = Departamento::query();

        if (!auth()->user()->is_admin) {
            $servidorId = auth()->user()->servidor->id;
            $departamentosQuery = $departamentosQuery->whereIn('id', function ($query) use ($servidorId) {
                $query->select('departamento_id')
                    ->from('departamento_servidor')
                    ->where('servidor_id', $servidorId);
            });
        }

        if ($request->has('search')) {
            $search = $request->search;
            $departamentosQuery->where('nomeDepartamento', 'like', "%$search%");
        }

        $departamentos = $departamentosQuery->paginate(10);
        $secretarias = Secretaria::all();

        if ($departamentos->isEmpty()) {
            $mensagem = "Nenhum departamento cadastrado";
            return view('admin.departamento.lista', compact('departamentos', 'mensagem', 'secretarias'));
        }

        return view('admin.departamento.lista', compact('departamentos', 'secretarias'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param int $secretaria_id
     * @return \Illuminate\Http\Response
     */
    public function create($secretaria_id)
    {
        $servidores = Servidor::all();
        $secretarias = Secretaria::all();

        if ($secretaria_id == 0) {
            return view('admin.departamento.novo', compact( 'servidores', 'secretarias'));
        }
            return view('admin.departamento.create', compact('secretaria_id', 'servidores'));
    }

    public function relatorioDepartamento(Request $request, $departamento_id){
        $totalTasks = DepartamentoTarefa::where('departamento_id', $departamento_id)->count();

        $year = Carbon::now()->year;
        $totalTasksByMonth = [];

        for ($month = 1; $month <= 12; $month++) {
            $totalTasksMounth = DepartamentoTarefa::where('departamento_id', $departamento_id)
                ->whereMonth('data_conclusao', $month)
                ->whereYear('data_conclusao', $year)
                ->count();

            $totalTasksByMonth[$month] = $totalTasksMounth;
        }

        //SITUACOES DAS TAREFAS
        $backlogTasks = DepartamentoTarefa::where('situacao', 0)->where('departamento_id', $departamento_id)->count();
        $doingTasks = DepartamentoTarefa::where('situacao', 1)->where('departamento_id', $departamento_id)->count();
        $codeReviewTasks = DepartamentoTarefa::where('situacao', 2)->where('departamento_id', $departamento_id)->count();
        $closedTasks = DepartamentoTarefa::where('situacao', 3)->where('departamento_id', $departamento_id)->count();
        $openTasks = DepartamentoTarefa::where('situacao', '<>', 3)->where('departamento_id', $departamento_id)->count();

        //CLASSIFICACAO DAS TAREFAS
        $baixaPrioridade = DepartamentoTarefa::where('classificacao', 0)->where('departamento_id', $departamento_id)->count();
        $mediaPrioridade = DepartamentoTarefa::where('classificacao', 1)->where('departamento_id', $departamento_id)->count();
        $altaPrioridade = DepartamentoTarefa::where('classificacao', 2)->where('departamento_id', $departamento_id)->count();

        //PORCENTAGENS DE SITUACOES DAS TAREFAS
        if ($totalTasks !== 0) {
            $porcentBaixaPrioridade = ($baixaPrioridade / $totalTasks) * 100;
            $porcentMediaPrioridade = ($mediaPrioridade / $totalTasks) * 100;
            $porcentAltaPrioridade = ($altaPrioridade / $totalTasks) * 100;
            $porcentTarefasFechadas = ($closedTasks / $totalTasks) * 100;
        } else {
            $porcentBaixaPrioridade = 0;
            $porcentMediaPrioridade = 0;
            $porcentAltaPrioridade = 0;
            $porcentTarefasFechadas = 0;
        }

        $tarefasEmAtrasoDepartamento = DepartamentoTarefa::whereDate('data_conclusao_prevista', '<', now())
            ->where('data_conclusao', '=', null)
            ->where('departamento_id','=', $departamento_id)
            ->get();

        $porcentagemAndamento = ($closedTasks / max($closedTasks + $openTasks, 1)) * 100;

        return view('admin.departamento.relatorio', compact('totalTasks','openTasks', 'closedTasks', 'backlogTasks',
            'doingTasks', 'codeReviewTasks', 'porcentBaixaPrioridade', 'porcentMediaPrioridade', 'porcentAltaPrioridade',
            'porcentTarefasFechadas', 'porcentagemAndamento', 'totalTasksByMonth', 'tarefasEmAtrasoDepartamento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function createServidor($id)
    {
        $departamento = Departamento::findOrFail($id);

        //RETORNA SOMENTE SERVIDORES QUE NÃO ESTÃO ASSOCIADOS AO DEPARTAMENTO
        $servidores = Servidor::whereNotIn('id', function ($query) use ($id) {
            $query->select('servidor_id')
                ->from('departamento_servidor')
                ->where('departamento_id', $id);
        })->get();

        return view('admin.departamento.servidor', compact('servidores', 'departamento'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartamentoRequest $request)
    {

        try {
            DB::beginTransaction();

            $departamento = Departamento::create([
                'secretaria_id' => $request->secretaria_id,
                'nomeDepartamento' => mb_strtoupper($request->nomeDepartamento),
                'administrador_id' => $request->administrador_id
            ]);

            DB::commit();

            // Reset CSRF token
            $request->session()->regenerateToken();
            return redirect()->back()->with(['type' => 'success', 'message' => 'Departamento Cadastrado!']);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'message' => 'Erro ao cadastrar departamento!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $secretaria_id)
    {
        $secretaria = Secretaria::findOrFail($secretaria_id);
        $departamentos = Departamento::query();
        if($request->has('search')){
            $search = $request->search;
            $departamentos->where('nomeDepartamento', 'like', "%$search%");
        }
        $departamentos->where('secretaria_id', $secretaria_id);
        $departamentos = $departamentos->paginate(10);
//
        if ($departamentos->count() === 0) {
            $mensagem = "Nenhum departamento cadastrado";
            return view('admin.departamento.index', compact('departamentos', 'secretaria_id', 'mensagem', 'secretaria'));
        }
        return view('admin.departamento.index', compact('departamentos', 'secretaria_id', 'secretaria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departamento = Departamento::findOrFail($id);
        $servidores = Servidor::all();
        return view('admin.departamento.edit', compact('departamento', 'servidores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartamentoRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $departamento = Departamento::findOrFail($id);

            $departamento->update([
                'secretaria_id' => $request->secretaria_id,
                'nomeDepartamento' => mb_strtoupper($request->nomeDepartamento),
                'administrador_id' => $request->administrador_id
            ]);

            DB::commit();

            // Reset CSRF token
            $request->session()->regenerateToken();
            return redirect()->back()->with(['type' => 'success', 'message' => 'Departamento atualizado com sucesso!']);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'message' => 'Erro ao atualizar departamento!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $departamento = Departamento::findOrFail($id);
            $departamento->delete();

            DB::commit();
            return redirect()->back()->with(['type' => 'success', 'message' => 'Departamento excluído com sucesso!']);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'message' => 'Erro ao excluir departamento!']);
        }
    }
}
