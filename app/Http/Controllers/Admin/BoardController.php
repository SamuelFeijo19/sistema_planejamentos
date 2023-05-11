<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $departamento_id)
    {
        return view('layouts.dashboard.board');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($secretaria_id)
    {
        //
        return view('admin.departamento.create', compact('secretaria_id'));
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
            $departamento = Departamento::create([
                'secretaria_id' => $request->secretaria_id,
                'nomeDepartamento' => mb_strtoupper($request->nomeDepartamento),

            ]);
            DB::commit();
            //resetar csrf token
            $request->session()->regenerateToken();
            return "Departamento Cadastrado!";
        } catch (Exception $exception) {
            dd($exception);
            DB::rollBack();
            return "Erro ao cadastrar departamento!";
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
