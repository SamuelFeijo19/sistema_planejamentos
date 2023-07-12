<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartamentoRequest;
use App\Models\Departamento;
use App\Models\DepartamentoServidor;
use App\Models\DepartamentoTarefa;
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
        return $this->generateRelatorio($departamento_id, 'departamento');
    }

    public function relatorioDivisao(Request $request, $divisao_id)
    {
        return $this->generateRelatorio($divisao_id, 'divisao');
    }

    private function generateRelatorio($id, $type)
    {
        $model = $type == 'departamento' ? 'DepartamentoTarefa' : 'DivisaoTarefa';

        if ($model == "DepartamentoTarefa")
            $model = new DepartamentoTarefa;
        else
            $model = new DivisaoTarefa;

        $totalTasks = $model::where($type . '_id', $id)->count();

        $year = Carbon::now()->year;
        $totalTasksByMonth = [];

        for ($month = 1; $month <= 12; $month++) {
            $totalTasksMonth = $model::where($type . '_id', $id)
                ->whereMonth('data_conclusao', $month)
                ->whereYear('data_conclusao', $year)
                ->count();

            $totalTasksByMonth[$month] = $totalTasksMonth;
        }

        //SITUACOES DAS TAREFAS
        $backlogTasks = $model::where('situacao', 0)->where($type . '_id', $id)->count();
        $doingTasks = $model::where('situacao', 1)->where($type . '_id', $id)->count();
        $codeReviewTasks = $model::where('situacao', 2)->where($type . '_id', $id)->count();
        $closedTasks = $model::where('situacao', 3)->where($type . '_id', $id)->count();
        $openTasks = $model::where('situacao', '<>', 3)->where($type . '_id', $id)->count();

        //CLASSIFICACAO DAS TAREFAS
        $baixaPrioridade = $model::where('classificacao', 0)->where($type . '_id', $id)->count();
        $mediaPrioridade = $model::where('classificacao', 1)->where($type . '_id', $id)->count();
        $altaPrioridade = $model::where('classificacao', 2)->where($type . '_id', $id)->count();

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

        $tarefasEmAtraso = $model::whereDate('data_conclusao_prevista', '<', now())
            ->where('data_conclusao', '=', null)
            ->where($type . '_id', '=', $id)
            ->get();

        $porcentagemAndamento = ($closedTasks / max($closedTasks + $openTasks, 1)) * 100;

        return view('admin.departamento.relatorio', compact('totalTasks','openTasks', 'closedTasks', 'backlogTasks',
            'doingTasks', 'codeReviewTasks', 'porcentBaixaPrioridade', 'porcentMediaPrioridade', 'porcentAltaPrioridade',
            'porcentTarefasFechadas', 'porcentagemAndamento', 'totalTasksByMonth', 'tarefasEmAtraso'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
