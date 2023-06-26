<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\DepartamentoServidor;
use App\Models\Secretaria;
use App\Models\Servidor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $secretaria_id
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
     * @param  int  $secretaria_id
     * @return \Illuminate\Http\Response
     */
    public function create($secretaria_id)
    {
        $servidores = Servidor::all();
        return view('admin.departamento.create', compact('secretaria_id', 'servidores'));
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
    public function store(Request $request)
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
    public function update(Request $request, $id)
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

            return response()->json(['msg' => 'Departamento excluído com sucesso!'], 200);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['msg' => 'Erro ao excluir departamento!'], 500);
        }
    }
}
