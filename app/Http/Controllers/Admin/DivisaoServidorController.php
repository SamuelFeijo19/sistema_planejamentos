<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LotacaoStoreRequest;
use App\Models\Departamento;
use App\Models\DepartamentoServidor;
use App\Models\DivisaoServidor;
use App\Models\Servidor;
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

//        if ($request->has('search')) {
//            $search = $request->search;
//
//            $matriculasQuery->join('participantes', 'matriculas.participante_id', '=', 'participantes.id')
//                ->join('users', 'participantes.user_id', '=', 'users.id')
//                ->join('eventos', 'matriculas.evento_id', '=', 'eventos.id')
//                ->where('name', 'like', "%$search%")
//                ->orWhere('nomeEvento', 'like', "%$search%")
//                ->select('matriculas.*', 'users.name');
//        }

//        $matriculas = $matriculasQuery->paginate(7);

//        if ($matriculas->count() === 0) {
//            return redirect()->route('matriculas.index')->with(['type' => 'error', 'message' => 'Nenhuma matrícula encontrada com as informações fornecidas']);
//        }

        return view('admin.divisoes.servidor_divisao', compact('lotacaoDivisao'));
    }

    public function show($divisao_id)
    {
        $lotacoesDivisao=DivisaoServidor::all();
        $lotacoesDivisao->where('divisao_id', $divisao_id);
        return view('admin.divisoes.servidor_divisao', compact('lotacoesDivisao'));
    }

//    public function create()
//    {
//        $eventos = Evento::whereDate('dataInicio', '>=', now())->get();
//
//        $participantes = Participante::all();
//        return view('admin.matriculas.create', compact('eventos', 'participantes'));
//    }

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
            return 'Lotação Divisao realizada com sucesso!';
        } catch (Exception $exception) {
            DB::rollBack();
            return 'Erro ao realizar Lotação!';
        }
    }

//    public function edit($id)
//    {
//        $eventos = Evento::all();
//        $matricula = Matricula::findOrFail($id);
//        return view('admin.matriculas.edit', compact('matricula', 'eventos'));
//    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $lotacao = DepartamentoServidor::findOrFail($id);
            $lotacao->update([
                'servidor_id' => mb_strtoupper($request->servidor_id),
                'departamento_id' => $request->departamento_id,
            ]);
            DB::commit();
            $request->session()->regenerateToken();
            return "Lotação atualizada com sucesso!";
        } catch (Exception $exception) {
            DB::rollBack();
            return "Falha na atualizada!";
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            DepartamentoServidor::findOrFail($id)->ForceDelete();
            DB::commit();
            return response()->json(['msg' => 'Lotação excluída com sucesso!'], 200);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'msg' => 'Erro ao excluir Lotação!',
            ], 401);
        }
    }
}
