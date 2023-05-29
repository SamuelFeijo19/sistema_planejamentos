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

        $divisaoTarefas = Divisaotarefa::join('divisao_servidor', 'divisao_servidor.divisao_id', '=', 'divisao_tarefa.divisao_id')
            ->get();
        return view('layouts.dashboard.home', compact('departamentos', 'divisoes','departamentoTarefas', 'divisaoTarefas'));
    }

}
