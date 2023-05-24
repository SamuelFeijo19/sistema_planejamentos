<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LotacaoStoreRequest;
use App\Models\Departamento;
use App\Models\DepartamentoServidor;
use App\Models\Servidor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartamentoServidorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departamento_id = $request->input('departamento_id');

        $lotacoesDepartamento = DepartamentoServidor::where('departamento_id', $departamento_id)->get();

        return view('admin.departamento.servidor_departamento', compact('lotacoesDepartamento'));
    }

    public function show(Request $request, $departamento_id)
    {
        $lotacoesDepartamento = DepartamentoServidor::query();

        if ($request->has('search')) {
            $search = $request->search;
            $lotacoesDepartamento->whereHas('servidor.user', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            });
        }

        $lotacoesDepartamento->where('departamento_id', $departamento_id);

        $lotacoesDepartamento = $lotacoesDepartamento->paginate(10);

        if ($lotacoesDepartamento->isEmpty()) {
            $mensagem = "Nenhum servidor encontrao";
            return view('admin.departamento.servidor_departamento', compact('lotacoesDepartamento', 'departamento_id', 'mensagem'));
        }

        return view('admin.departamento.servidor_departamento', compact('lotacoesDepartamento', 'departamento_id'));
    }

    public function create($departamento_id)
    {
        $departamento = Departamento::findOrFail($departamento_id);

        //RETORNA SOMENTE SERVIDORES QUE NÃO ESTÃO ASSOCIADOS AO DEPARTAMENTO
        $servidores = Servidor::whereNotIn('id', function ($query) use ($departamento_id) {
            $query->select('servidor_id')
                ->from('departamento_servidor')
                ->where('departamento_id', $departamento_id);
        })->get();
        return view('admin.departamento_servidor.create', compact('departamento', 'servidores'));
    }

    public function store(LotacaoStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $lotacaoDepartamento = DepartamentoServidor::create([
                'servidor_id' => mb_strtoupper($request->servidor_id),
                'departamento_id' => $request->departamento_id,
            ]);
            //MATA O TOKEN PARA NÃO DAR ERRO DE DUPLICIDADE
            $request->session()->regenerateToken();
            DB::commit();
            return 'Lotação realizada com sucesso!';
        } catch (Exception $exception) {
            DB::rollBack();
            return 'Erro ao realizar Lotação!';
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $lotacaoDepartamento = DepartamentoServidor::findOrFail($id);
            $lotacaoDepartamento->update([
                'servidor_id' => mb_strtoupper($request->servidor_id),
                'departamento_id' => $request->departamento_id,
            ]);
            DB::commit();
            $request->session()->regenerateToken();
            return "Lotação atualizada com sucesso!";
        } catch (Exception $exception) {
            DB::rollBack();
            return "Falha na atualização!";
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            DepartamentoServidor::findOrFail($id)->ForceDelete();
            DB::commit();
            return response()->json(['msg' => 'Lotação do servidor no departamento excluída com sucesso!'], 200);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'msg' => 'Erro ao excluir do servidor no departamento!',
            ], 401);
        }
    }
}
