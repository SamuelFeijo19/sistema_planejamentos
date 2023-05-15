<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LotacaoStoreRequest;
use App\Models\Departamento;
use App\Models\Lotacao;
use App\Models\Servidor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LotacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lotacao = Lotacao::query();

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

        return view('admin.departamento.servidor_departamento', compact('lotacao'));
    }

    public function show($departamento_id)
    {
        $lotacoes=Lotacao::all();
        $lotacoes->where('departamento_id', $departamento_id);
        return view('admin.departamento.servidor_departamento', compact('lotacoes'));
    }

    public function create()
    {
        $eventos = Evento::whereDate('dataInicio', '>=', now())->get();

        $participantes = Participante::all();
        return view('admin.matriculas.create', compact('eventos', 'participantes'));
    }

    public function store(LotacaoStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $lotacao = Lotacao::create([
                'servidor_id' => mb_strtoupper($request->servidor_id),
                'departamento_id' => $request->departamento_id,
            ]);
            //MATA O TOKEN PARA NÃO DAR ERRO DE DUPLICIDADE
            $request->session()->regenerateToken();
            DB::commit();
            return 'Matricula realizada com sucesso!';
        } catch (Exception $exception) {
            DB::rollBack();
            return 'Erro ao realizar matricula!';
        }
    }

    public function edit($id)
    {
        $eventos = Evento::all();
        $matricula = Matricula::findOrFail($id);
        return view('admin.matriculas.edit', compact('matricula', 'eventos'));
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $matricula = Matricula::findOrFail($id);
            $eventos = Evento::all();
            $participantes = Participante::all();
            $matricula->update([
                'usuario_id' => $request->participante_id,
                'evento_id' => $request->evento_id,
                'valida_matricula' => $request->validaMatricula,
                'libera_certificado' => $request->liberarCertificado
            ]);
            DB::commit();
            $request->session()->regenerateToken();
            return redirect()->route('matriculas.index')->with(['type' => 'success', 'message' => 'Matricula atualizada com sucesso!', 'title' => 'Sucesso!']);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('matriculas.create')->with(['type' => 'error', 'message' => 'Erro ao tentar atualizar a matricula!', 'title' => 'Erro!']);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Matricula::findOrFail($id)->ForceDelete();
            DB::commit();
            return response()->json(['msg' => 'Matrícula excluída com sucesso!'], 200);
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'msg' => 'Erro ao excluir matricula!',
            ], 401);
        }
    }
}
