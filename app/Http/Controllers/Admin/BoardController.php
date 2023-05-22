<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\DepartamentoServidor;
use App\Models\Servidor;
use App\Models\DepartamentoTarefa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    public function index(Request $request, $departamento_id)
    {
        //BUSCAR APENAS SERVIDORES QUE ESTÃO CADASTRADOS NO DEPARTAMENTO
        $servidores = Servidor::with('user')
            ->join('departamento_servidor', 'servidores.id', '=', 'departamento_servidor.servidor_id')
            ->where('departamento_servidor.departamento_id', $departamento_id)
            ->get();

        $departamento = Departamento::find($departamento_id);

        //BUSCAR TAREFAS QUE QUE ESTÃO CADASTRADAS NO DEPARTAMENTO
        $tarefas = DepartamentoTarefa::where('departamento_id', $departamento_id)->get();

        return view('layouts.dashboard.board', compact('servidores', 'departamento', 'tarefas'));
    }

    public function create($id)
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
