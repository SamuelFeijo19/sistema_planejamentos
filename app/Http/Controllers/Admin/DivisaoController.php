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
            $mensagem = "Nenhum conteúdo cadastrado";
            return view('admin.divisoes.lista', compact('divisoes', 'mensagem', 'departamento'));
        }

        return view('admin.divisoes.lista', compact('divisoes', 'departamento'));
    }

    public function create($departamento_id)
    {
        $servidores = Servidor::all();
        return view('admin.divisoes.create', compact('departamento_id', 'servidores'));
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
                'administrador_id' => $request->administrador_id
            ]);

            DB::commit();

            $request->session()->regenerateToken();

            return "Divisão cadastrada!";
        } catch (Exception $exception) {
            DB::rollBack();

            return "Erro ao cadastrar divisão!";
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
            $mensagem = "Nenhuma Divisão encontrada";
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

    public function update(Request $request, $id)
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
            return redirect()->back()->with(['type' => 'success', 'message' => 'Divisao excluído com sucesso!']);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'message' => 'Erro ao excluir Divisa!']);
        }
    }
}
