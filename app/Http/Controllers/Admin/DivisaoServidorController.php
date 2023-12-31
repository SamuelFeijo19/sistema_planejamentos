<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\DepartamentoServidor;
use App\Models\Divisao;
use App\Models\Servidor;
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
        //
    }

    public function show(Request $request, $divisao_id)
    {
        $lotacoesDivisao = DivisaoServidor::query();
        $divisao = Divisao::findOrFail($divisao_id);
        if ($request->has('search')) {
            $search = $request->search;
            $lotacoesDivisao->whereHas('servidor.user', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            });
        }

        $lotacoesDivisao->where('divisao_id', $divisao_id);

        $lotacoesDivisao = $lotacoesDivisao->paginate(10);

        if ($lotacoesDivisao->isEmpty()) {
            $mensagem = "Nenhum servidor encontrao";
            return view('admin.divisao_servidor.index', compact('lotacoesDivisao', 'divisao_id', 'mensagem', 'divisao'));
        }

        return view('admin.divisao_servidor.index', compact('lotacoesDivisao', 'divisao_id', 'divisao'));
    }

    public function create($divisao_id)
    {
        $divisao = Divisao::findOrFail($divisao_id);

        $servidores = Servidor::whereNotIn('id', function ($query) use ($divisao_id) {
            $query->select('servidor_id')
                ->from('divisao_servidor')
                ->where('divisao_id', $divisao_id);
        })
            ->whereHas('lotacaoDepartamento', function ($query) use ($divisao) {
                $query->where('departamento_id', $divisao->departamento->id);
            })
            ->get();

        return view('admin.divisao_servidor.create', compact('servidores', 'divisao'));
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
            return redirect()->back()->with(['type' => 'success', 'message' => 'Lotação do servidor na divisão realizada com sucesso!']);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'message' => 'Erro ao realizar Lotação do servidor na divisão!']);
        }
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
        try {
            DB::beginTransaction();
            DepartamentoServidor::findOrFail($id)->ForceDelete();
            DB::commit();
            return redirect()->back()->with(['type' => 'success', 'message' => 'Lotação do servidor na divisão excluída com sucesso!']);
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'message' => 'Erro ao excluir Lotação do servidor na Divisão!']);
        }
    }
}
