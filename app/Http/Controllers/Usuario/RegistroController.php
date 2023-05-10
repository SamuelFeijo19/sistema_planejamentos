<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Http\Requests\Usuario\UsuarioStoreRequest;
use App\Models\Servidor;
use App\Models\User;
use Illuminate\Http\Response;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    public function create()
    {
        return view('usuario.cadastro');
    }

    public function store(UsuarioStoreRequest $request){
        try {
            DB::beginTransaction();
            $usuario = new User();
            $usuario->name = mb_strtoupper($request->input('name'));
            $usuario->email = $request->input('email');
            $usuario->password = Hash::make($request->input('password'));
            $usuario->save();
            $servidor = new Servidor();
            $servidor->user_id = $usuario->id;
            $servidor->data_nascimento = $request->input('dataNascimento');
            $servidor->cpf = $request->input('cpf');
            $servidor->matricula = $request->input('matricula');
            $servidor->save();
            DB::commit();
            $request->session()->regenerateToken();
            return response()->json(['message' => 'Cadastro realizado com sucesso'], Response::HTTP_CREATED);
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json(['message' => 'Não foi possível realizar o cadastro'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
