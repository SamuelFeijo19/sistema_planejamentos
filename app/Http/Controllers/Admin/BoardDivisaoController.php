<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Divisao;
use App\Models\DivisaoServidor;
use App\Models\DivisaoTarefa;
use App\Models\Servidor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoardDivisaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $divisao_id)
    {
        $servidorId= auth()->user()->servidor->id;

        // Verificar se o usuário tem uma entrada na tabela divisao_servidor com o servidor_id correspondente
        $divisaoServidor = DivisaoServidor::where('servidor_id', $servidorId)
            ->where('divisao_id', $divisao_id)
            ->first();

        if (!$divisaoServidor) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Você não faz parte desta divisão!']);
        }

        //BUSCAR APENAS SERVIDORES QUE ESTÃO CADASTRADOS NA DIVISAO
        $servidores = Servidor::with('user')
            ->join('divisao_servidor', 'servidores.id', '=', 'divisao_servidor.servidor_id')
            ->where('divisao_servidor.divisao_id', '=', $divisao_id)
            ->get();

        $divisao = Divisao::find($divisao_id);

        //BUSCAR TAREFAS QUE QUE ESTÃO CADASTRADAS NA DIVISAO
        $tarefas = DivisaoTarefa::where('divisao_id', $divisao_id)->get();

        return view('layouts.dashboard.boardDivisao', compact('servidores', 'divisao', 'tarefas'));
    }

    public function getTaskDetails($task_id)
    {
        // Fetch the task details from the database
        $task = DivisaoTarefa::findOrFail($task_id);

        return response()->json($task);
    }

    public function alternarQuadroDiv()
    {
        if (session('mostrarApenasMeuQuadro')) {
            session(['mostrarApenasMeuQuadro' => false]);
        } else {
            session(['mostrarApenasMeuQuadro' => true]);
        }

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }
}
