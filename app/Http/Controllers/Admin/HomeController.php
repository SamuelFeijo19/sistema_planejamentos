<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ModelNotFoundException;
use App\Models\DepartamentoServidor;
use App\Models\DepartamentoTarefa;
use App\Models\DivisaoServidor;
use App\Models\DivisaoTarefa;
use App\Models\User;
use App\Models\Servidor;
use App\Models\Departamento;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('layouts.dashboard.app');
    }

    public function content(Request $request)
    {

        $servidorId = auth()->user()->servidor->id; // Obtenha o ID do usuário logado na sessão

        $departamentos = DepartamentoServidor::where('servidor_id', $servidorId)->get();

        $departamentoTarefas = DepartamentoTarefa::join('departamento_servidor', 'departamento_servidor.departamento_id', '=', 'departamento_tarefa.departamento_id')
            ->get();


        $divisoes = DivisaoServidor::where('servidor_id', $servidorId)->get();

        $divisaoTarefas = Divisaotarefa::join('divisao_servidor', 'divisao_servidor.divisao_id', '=', 'divisao_tarefa.divisao_id')->get();

        $countDptTarefasAbertas = DepartamentoTarefa::where('criador_id', auth()->user()->id)->where('situacao', '<>', 3)->count();
        $countDivTarefasAbertas = DivisaoTarefa::where('criador_id', auth()->user()->id)->where('situacao', '<>', 3)->count();
        $countTarefasAbertas = ($countDptTarefasAbertas + $countDivTarefasAbertas);

        $countDptTarefasFechadas = DepartamentoTarefa::where('criador_id', auth()->user()->id)->where('situacao', '=', 3)->count();
        $countDivTarefasFechadas = DivisaoTarefa::where('criador_id', auth()->user()->id)->where('situacao', '=', 3)->count();
        $countTarefasfechadas = ($countDptTarefasFechadas + $countDivTarefasFechadas);

        $countDptTarefasUrgentes = DepartamentoTarefa::where('criador_id', auth()->user()->id)->where('situacao', '<>', 3)->where('classificacao', '=', 2)->count();
        $countDivTarefasUrgentes = DivisaoTarefa::where('criador_id', auth()->user()->id)->where('situacao', '<>', 3)->where('classificacao', '=', 2)->count();
        $countTarefasUrgentes = ($countDptTarefasUrgentes + $countDivTarefasUrgentes);

        $porcentagemAndamento = ($countTarefasfechadas / $countTarefasAbertas) * 100;

        return view('layouts.dashboard.home', compact('departamentos', 'divisoes','departamentoTarefas', 'divisaoTarefas', 'countTarefasAbertas', 'countTarefasfechadas', 'porcentagemAndamento', 'countTarefasUrgentes'));
    }

}
