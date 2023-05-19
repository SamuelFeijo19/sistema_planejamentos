<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Divisao;
use App\Models\Servidor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivisaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $departamento_id)
    {
        $divisoes = Divisao::where('departamento_id', $departamento_id)->get();


        return view('admin.divisoes.index', compact('divisoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($departamento_id)
    {
        //
        return view('admin.divisoes.create', compact('departamento_id'));
    }

    public function createServidor($id)
    {
        //BUSCA SOMENTE PARTICIPANTES QUE NÃO FORAM CADASTRADOS NO MESMO DEPARTAMENTO BUSCADO.
        $servidores = Servidor::whereNotIn('id', function ($query) use ($id) {
            $query->select('servidor_id')->from('divisao_servidor')->where('divisao_id', $id);
        })->get();

        $divisao = Divisao::findOrFail($id);

        return view('admin.divisoes.servidor', compact('servidores', 'divisao'));
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

        try {
            DB::beginTransaction();
            $divisao = Divisao::create([
                'departamento_id' => $request->departamento_id,
                'nomeDivisao' => mb_strtoupper($request->nomeDivisao),

            ]);
            DB::commit();
            //resetar csrf token
            $request->session()->regenerateToken();
            return "Divisao Cadastrada!";
        } catch (Exception $exception) {
            dd($exception);
            DB::rollBack();
            return "Erro ao cadastrar Divisao!";
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
        $departamento = Departamento::findOrFail($id);
        return view('admin.departamento.show', compact('departamento'));
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
        $departamento = Departamento::findOrFail($id);
        return view('admin.departamento.edit', compact('departamento'));
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
            $departamento = Departamento::findOrFail($id);
            $departamento->update([
                'secretaria_id' => $request->secretaria_id,
                'nomeDepartamento' => mb_strtoupper($request->nomeDepartamento),
            ]);
            DB::commit();
            //resetar csrf token
            $request->session()->regenerateToken();
            return view('admin.conteudo.index', $departamento->secretaria_id);
        } catch (Exception $exception) {
            DB::rollBack();
            return "erro ao atualizar departamento!";
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
            return response()->json(['msg' => 'Departamento excluído com sucesso!'], 200);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['msg' => 'Erro ao excluir departamento!'], 500);
        }
    }
}
