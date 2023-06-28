<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DivisaoRequest;
use App\Models\Departamento;
use App\Models\Divisao;
use App\Models\Secretaria;
use App\Models\Servidor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivisaoController extends Controller
{

    public function index(Request $request)
    {
        $divisoesQuery = Divisao::query();

        if (!auth()->user()->is_admin) {
            $servidorId = auth()->user()->servidor->id;
            $divisoesQuery = $divisoesQuery->whereIn('id', function ($query) use ($servidorId) {
                $query->select('divisao_id')
                    ->from('divisao_servidor')
                    ->where('servidor_id', $servidorId);
            });
        }

        if ($request->has('search')) {
            $search = $request->search;
            $divisoesQuery->where('nomeDivisao', 'like', "%$search%");
        }

        $divisoes = $divisoesQuery->paginate(10);
        $departamento = Departamento::all();

        if ($divisoes->isEmpty()) {
            $mensagem = "Nenhuma divisão cadastrada";
            return view('admin.divisoes.lista', compact('divisoes', 'mensagem', 'departamento'));
        }

        return view('admin.divisoes.lista', compact('divisoes', 'departamento'));
    }

    public function create($departamento_id)
    {
        $servidores = Servidor::all();
        $secretarias = Secretaria::all();
        $departamentos = Departamento::all();

        if ($departamento_id == 0) {
            return view('admin.divisoes.novo', compact( 'servidores', 'departamentos', 'secretarias'));
        }
        return view('admin.divisoes.create', compact('departamento_id', 'servidores'));
    }

    public function createServidor($id)
    {
        $divisao = Divisao::findOrFail($id);

        $servidores = Servidor::whereNotIn('id', function ($query) use ($id) {
            $query->select('servidor_id')
                ->from('divisao_servidor')
                ->where('divisao_id', $id);
        })
            ->whereHas('lotacaoDepartamento', function ($query) use ($divisao) {
                $query->where('departamento_id', $divisao->departamento->id);
            })
            ->get();

        return view('admin.divisoes.servidor', compact('servidores', 'divisao'));
    }

    public function getBySecretaria(Request $request, $secretaria_id)
    {
        $departamentos = Departamento::where('secretaria_id', $secretaria_id)->get();

        return response()->json($departamentos);
    }

    public function store(DivisaoRequest $request)
    {
        try {
            DB::beginTransaction();

            $divisao = Divisao::create([
                'departamento_id' => $request->departamento_id,
                'nomeDivisao' => mb_strtoupper($request->nomeDivisao),
                'administrador_id' => $request->administrador_id
            ]);

            DB::commit();

            $request->session()->regenerateToken();
            return redirect()->back()->with(['type' => 'success', 'message' => 'Divisão cadastrada com sucesso!']);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'message' => 'Erro ao cadastrar divisão!']);
        }
    }

    public function show(Request $request, $departamento_id)
    {
        $departamento = Departamento::findOrFail($departamento_id);

        $divisoes = Divisao::query();
        if($request->has('search')){
            $search = $request->search;
            $divisoes->where('nomeDivisao', 'like', "%$search%");
        }
        $divisoes->where('departamento_id', $departamento_id);
        $divisoes = $divisoes->paginate(10);

        if ($divisoes->count() === 0) {
            $mensagem = "Nenhuma divisão cadastrada";
            return view('admin.divisoes.index', compact('divisoes', 'departamento_id', 'mensagem', 'departamento'));
        }
        return view('admin.divisoes.index', compact('divisoes', 'departamento_id', 'departamento'));
    }

    public function edit($id)
    {
        $divisao = Divisao::findOrFail($id);
        $servidores = Servidor::all();
        return view('admin.divisoes.edit', compact('divisao', 'servidores'));
    }

    public function update(DivisaoRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $divisao = Divisao::findOrFail($id);

            $divisao->update([
                'departamento_id' => $request->departamento_id,
                'nomeDivisao' => mb_strtoupper($request->nomeDivisao),
                'administrador_id' => $request->administrador_id
            ]);

            DB::commit();

            $request->session()->regenerateToken();
            return redirect()->back()->with(['type' => 'success', 'message' => 'Divisao atualizada com sucess!']);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'message' => 'Erro ao atualizar divisao!']);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $divisao = Divisao::findOrFail($id);
            $divisao->delete();

            DB::commit();
            return redirect()->back()->with(['type' => 'success', 'message' => 'Divisao excluído com sucesso!']);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'message' => 'Erro ao excluir Divisa!']);
        }
    }
}
