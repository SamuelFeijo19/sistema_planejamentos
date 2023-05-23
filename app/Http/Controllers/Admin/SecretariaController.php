<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SecretariaStoreRequest;
use App\Models\Secretaria;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SecretariaController extends Controller
{
    public function index(Request $request)
    {
        $secretarias = Secretaria::query();
        if($request->has('search')){
            $search = $request->search;
            $secretarias->where('nomeSecretaria', 'like', "%$search%")->get();
        }
        $secretarias = $secretarias->paginate(10);
//
        if ($secretarias->count() === 0) {
            return redirect()->route('secretarias.index')->with(['type' => 'error', 'message' => 'Secretaria não encontrada!']);
        }

        return view('admin.secretarias.index', compact('secretarias'));
    }

    public function show($id)
    {
        $secretarias = Secretaria::findOrFail($id);
        return view('admin.secretarias.index', compact('secretarias'));
    }
    public function create()
    {
        $secretarias = Secretaria::all();
        return view('admin.secretarias.create', compact('secretarias'));
    }

    public function store(SecretariaStoreRequest $request)
    {
        try {
            DB::beginTransaction();
            $secretaria = Secretaria::create([
                'nomeSecretaria' => mb_strtoupper($request->nomeSecretaria),
                'siglaSecretaria' => $request->siglaSecretaria,
            ]);
            //MATA O TOKEN PARA NÃO DAR ERRO DE DUPLICIDADE
            $request->session()->regenerateToken();
            DB::commit();
            return redirect()->route('secretarias.index')->with(['type' => 'success', 'message' => 'Secretaria cadastrada com sucesso!']);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('secretarias.create')->with(['type' => 'error', 'message' => 'Erro ao cadastrar secretaria!']);
        }
    }
    public function edit($id)
    {
        $secretaria = Secretaria::findOrFail($id);
        return view('admin.secretarias.edit', compact('secretaria'));
    }
    public function update(Request $request, $id)
    {
        try {
            $secretaria = Secretaria::findOrFail($id);
            DB::beginTransaction();
            $secretaria->update([
                'nomeSecretaria' => $request->nomeSecretaria,
                'siglaSecretaria' => $request->siglaSecretaria,
            ]);
            DB::commit();
            //MATA O TOKEN PARA NÃO DAR ERRO DE DUPLICIDADE
            $request->session()->regenerateToken();
            return redirect()->route('secretarias.index', $id)->with(['type' => 'success', 'message' => 'Secretaria editada com sucesso!', 'title' => 'Sucesso!']);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->route('secretarias.edit', $id)->with(['type' => 'error', 'message' => 'Erro ao editar secretaria!', 'title' => 'Erro!']);
        }

    }
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Secretaria::findOrFail($id)->ForceDelete();
            DB::commit();
            return response()->json('');
        } catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'msg' => $ex->getMessage()
            ], 401);
        }
    }
}
