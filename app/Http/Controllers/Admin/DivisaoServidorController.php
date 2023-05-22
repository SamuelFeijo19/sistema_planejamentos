<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\DepartamentoServidor;
use App\Models\DivisaoServidor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivisaoServidorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lotacaoDivisao = DivisaoServidor::query();

        return view('admin.divisoes.servidor_divisao', compact('lotacaoDivisao'));
    }

    public function show($divisao_id)
    {
        $lotacoesDivisao=DivisaoServidor::all();
        $lotacoesDivisao->where('divisao_id', $divisao_id);
        return view('admin.divisoes.servidor_divisao', compact('lotacoesDivisao'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        try {
//            dd($request);
            DB::beginTransaction();
            $lotacaoDivisao = DivisaoServidor::create([
                'servidor_id' => mb_strtoupper($request->servidor_id),
                'divisao_id' => $request->divisao_id,
            ]);
            //MATA O TOKEN PARA NÃO DAR ERRO DE DUPLICIDADE
            $request->session()->regenerateToken();
            DB::commit();
            return 'Lotação do servidor na divisão realizada com sucesso!';
        } catch (Exception $exception) {
            DB::rollBack();
            return 'Erro ao realizar Lotação do servidor na divisão!';
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
            $lotacaoDivisao = DivisaoServidor::findOrFail($id);
            $lotacaoDivisao->update([
                'servidor_id' => mb_strtoupper($request->servidor_id),
                'divisao_id' => $request->divisao_id,
            ]);
            DB::commit();
            $request->session()->regenerateToken();
            return "Lotação do servidor na divisão atualizada com sucesso!";
        } catch (Exception $exception) {
            DB::rollBack();
            return "Falha na atualização do servidor na divisão!";
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            DepartamentoServidor::findOrFail($id)->ForceDelete();
            DB::commit();
            return response()->json(['msg' => 'Lotação do servidor na divisão excluída com sucesso!'], 200);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'msg' => 'Erro ao excluir Lotação do servidor na Divisão!',
            ], 401);
        }
    }
}
