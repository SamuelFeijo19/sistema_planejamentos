<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.perfil.index');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        $servidor = $user->servidor;
        return view('admin.perfil.index', compact('servidor'));
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $servidor = $user->servidor;
            DB::beginTransaction();
            $servidor->update([
                'data_nascimento' => date('Y-m-d', strtotime($request->dataNascimento)),
                'cpf' => $request->cpf,
                'matricula' => $request->matricula
            ]);
            $servidor->user()->update([
                'name' => $request->nome,
                'email' => $request->email,
                'password' => !is_null($request->password) ? Hash::make($request->password) : $servidor->user->password
            ]);
            DB::commit();
            $request->session()->regenerateToken();
            return redirect()->route('perfil.show', $id)->with(['type' => 'success', 'message' => 'Usuário atualizado com sucesso!', 'title' => 'Sucesso!']);
        } catch (Exception $exception) {
            DB::rollBack();
//            dd($exception->getMessage());
            return redirect()->route('perfil.show', $id)->with(['type' => 'error', 'message' => 'Erro ao atualizar usuário!', 'title' => 'Erro!']);
        }
    }
}
