<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DepartamentoServidor;
use App\Models\DepartamentoTarefa;
use App\Models\DivisaoServidor;
use App\Models\DivisaoTarefa;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('layouts.dashboard.app');
    }

    public function content(Request $request)
    {
        // OBTEM O ID DO SERVIDOR LOGADO NA SESSÃO
        $servidorId = auth()->user()->servidor->id; // Obtenha o ID do usuário logado na sessão

        // OBTEM TODOS OS DEPARTAMENTOS QUE O SERVIDOR ESTÁ LOTADO
        $departamentos = DepartamentoServidor::where('servidor_id', $servidorId)->get();

        // OBTEM TODAS AS DIVISÕES QUE O SERVIDOR ESTÁ LOTADO
        $divisoes = DivisaoServidor::where('servidor_id', $servidorId)->get();

        // OBTEM TODAS AS TAREFAS ABERTAS CRIADAS PELO SERVIDOR (DEPARTAMENTOS E DIVISOES)
        $countTarefasAbertas = DepartamentoTarefa::where('situacao', '<>', 3)
            ->whereIn('criador_id', [auth()->user()->id])
            ->union(
                DivisaoTarefa::where('situacao', '<>', 3)
                    ->whereIn('criador_id', [auth()->user()->id])
            )->count();

        // OBTEM TODAS AS TAREFAS FECHADAS CRIADAS PELO SERVIDOR (DEPARTAMENTOS E DIVISOES)
        $countTarefasfechadas = DepartamentoTarefa::where('situacao', 3)
            ->whereIn('criador_id', [auth()->user()->id])
            ->union(
                DivisaoTarefa::where('situacao', 3)
                    ->whereIn('criador_id', [auth()->user()->id])
            )->count();

        // OBTEM TODAS AS TAREFAS DE STATUS URGENTE CRIADAS PELO SERVIDOR (DEPARTAMENTOS E DIVISOES)
        $countTarefasUrgentes = DepartamentoTarefa::where('situacao', '<>', 3)
            ->where('classificacao', 2)
            ->whereIn('criador_id', [auth()->user()->id])
            ->union(
                DivisaoTarefa::where('situacao', '<>', 3)
                    ->where('classificacao', 2)
                    ->whereIn('criador_id', [auth()->user()->id])
            )->count();

        // PORCENTAGEM DO ANDAMENTO DAS TAREFAS
        $porcentagemAndamento = ($countTarefasfechadas / max($countTarefasfechadas + $countTarefasAbertas, 1)) * 100;
        return view('layouts.dashboard.home', compact('departamentos', 'divisoes', 'countTarefasAbertas',
            'countTarefasfechadas', 'porcentagemAndamento', 'countTarefasUrgentes'));
    }

}
