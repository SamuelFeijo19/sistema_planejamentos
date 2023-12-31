<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartamentoRequest;
use App\Models\Departamento;
use App\Models\DepartamentoServidor;
use App\Models\DepartamentoTarefa;
use App\Models\Divisao;
use App\Models\DivisaoServidor;
use App\Models\DivisaoTarefa;
use App\Models\Secretaria;
use App\Models\Servidor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RelatorioController extends Controller
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
        return view('admin.departamento.relatorio');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param int $secretaria_id
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function relatorioDepartamento(Request $request, $departamento_id)
    {
        $servidorId= auth()->user()->servidor->id;

        // Verificar se o usuário tem uma entrada na tabela departamento_servidor com o servidor_id correspondente
        $departamentoServidor = DepartamentoServidor::where('servidor_id', $servidorId)
            ->where('departamento_id', $departamento_id)
            ->first();

        if (!$departamentoServidor) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Você não faz parte deste departamento!']);
        }

        return $this->generateRelatorio($departamento_id, new DepartamentoTarefa());
    }

    public function relatorioDivisao(Request $request, $divisao_id)
    {
        $servidorId= auth()->user()->servidor->id;

        // Verificar se o usuário tem uma entrada na tabela departamento_servidor com o servidor_id correspondente
        $divisaoServidor = DivisaoServidor::where('servidor_id', $servidorId)
            ->where('divisao_id', $divisao_id)
            ->first();

        if (!$divisaoServidor) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Você não faz parte desta divisão!']);
        }

        return $this->generateRelatorio($divisao_id, new DivisaoTarefa());
    }

    private function getNomeUnidadeAdministrativa($id, $model)
    {
        if ($model == new DepartamentoTarefa()) {
            $departamento = Departamento::find($id);
            if ($departamento) {
                return $departamento->nomeDepartamento;
            }
        } elseif ($model == new DivisaoTarefa()) {
            $divisao = Divisao::find($id);
            if ($divisao) {
                return $divisao->nomeDivisao;
            }
        }

        return null;
    }

    private function generateRelatorio($id, $model)
    {
        $nomeUnidadeAdministrativa = $this->getNomeUnidadeAdministrativa($id, $model);

        $tabela = $model::where(function ($query) use ($id, $model) {
            $query->where($model == new DepartamentoTarefa() ? 'departamento_id' : 'divisao_id', $id);
        })->get();
        $totalTasks = $tabela->count();

        $year = Carbon::now()->year;
        $totalTasksByMonth = [];

        for ($month = 1; $month <= 12; $month++) {
            $totalTasksMonth = $model->where(function ($query) use ($id, $model, $month, $year) {
                $query->where($model == new DepartamentoTarefa() ? 'departamento_id' : 'divisao_id', $id)
                    ->whereMonth('data_conclusao', $month)
                    ->whereYear('data_conclusao', $year);
            })->count();

            $totalTasksByMonth[$month] = $totalTasksMonth;
        }

        //SITUACOES DAS TAREFAS
        $backlogTasks = $tabela->where('situacao', 0)->count();
        $doingTasks = $tabela->where('situacao', 1)->count();
        $codeReviewTasks = $tabela->where('situacao', 2)->count();
      $closedTasks = $tabela->where('situacao', '=', 3)->count();
        $openTasks = $tabela->where('situacao', '<>', 3)->count();

        //CLASSIFICACAO DAS TAREFAS
        $baixaPrioridade = $tabela->where('classificacao', 0)->count();
        $mediaPrioridade = $tabela->where('classificacao', 1)->count();
        $altaPrioridade = $tabela->where('classificacao', 2)->count();

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

        $tarefasEmAtraso = $tabela->where('data_conclusao_prevista', '<', now())
            ->whereNull('data_conclusao');


        $porcentagemAndamento = ($closedTasks / max($closedTasks + $openTasks, 1)) * 100;

        return view('layouts.dashboard.relatorio', compact('nomeUnidadeAdministrativa', 'totalTasks', 'openTasks', 'closedTasks', 'backlogTasks',
            'doingTasks', 'codeReviewTasks', 'porcentBaixaPrioridade', 'porcentMediaPrioridade', 'porcentAltaPrioridade',
            'porcentTarefasFechadas', 'porcentagemAndamento', 'totalTasksByMonth', 'tarefasEmAtraso'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param int $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     *
     * /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
