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
    public function index(Request $request, $departamento_id)
    {
        $divisoes = Divisao::where('departamento_id', $departamento_id)->get();

        return view('admin.divisoes.index', compact('divisoes'));
    }

    public function create($departamento_id)
    {
        return view('admin.divisoes.create', compact('departamento_id'));
    }

    public function createServidor($id)
    {
        //BUSCAR APENAS SERVIDORES QUE NÃO ESTAO CADASTRADOS NA DIVISAO
        $servidores = Servidor::whereNotIn('id', function ($query) use ($id) {
            $query->select('servidor_id')->from('divisao_servidor')->where('divisao_id', $id);
        })->get();

        $divisao = Divisao::findOrFail($id);

        return view('admin.divisoes.servidor', compact('servidores', 'divisao'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $divisao = Divisao::create([
                'departamento_id' => $request->departamento_id,
                'nomeDivisao' => mb_strtoupper($request->nomeDivisao),
            ]);

            DB::commit();

            $request->session()->regenerateToken();

            return "Divisão cadastrada!";
        } catch (Exception $exception) {
            DB::rollBack();

            return "Erro ao cadastrar divisão!";
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $divisao = Divisao::findOrFail($id);

        return view('admin.divisoes.edit', compact('divisao'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $divisao = Divisao::findOrFail($id);

            $divisao->update([
                'departamento_id' => $request->departamento_id,
                'nomeDivisao' => mb_strtoupper($request->nomeDivisao),
            ]);

            DB::commit();

            $request->session()->regenerateToken();

            return 'Divisao atualizada com sucesso';
        } catch (Exception $exception) {
            DB::rollBack();

            return "Erro ao atualizar divisao!";
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $divisao = Divisao::findOrFail($id);
            $divisao->delete();

            DB::commit();

            return response()->json(['msg' => 'Divisao excluído com sucesso!'], 200);
        } catch (Exception $exception) {
            DB::rollBack();

            return response()->json(['msg' => 'Erro ao excluir Divisao!'], 500);
        }
    }
}
