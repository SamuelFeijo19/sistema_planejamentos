<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServidorStoreRequest;
use App\Models\Servidor;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ServidorController extends Controller
{
    public function index(Request $request)
    {
        $servidores = Servidor::all();

        return view('admin.servidor.index', compact('servidores'));
    }

    public function show($id)
    {
        $servidor = Servidor::findOrFail($id);
        return view('admin.servidor.index', compact('servidor'));
    }

    public function create()
    {
        $servidores = Servidor::all();
        return view('admin.servidor.create', compact('servidores'));
    }

    public function store(ServidorStoreRequest $request)
    {
        try {
            DB::beginTransaction();

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            //GERAR UM HASH ALÉATORIO PARA A SENHA DE 8 CARACTERES
            $password = $this->generatePassword();
            $user->password = Hash::make($password);
            $user->save();
            $user->servidor()->create([
                'data_nascimento' => date('Y-m-d', strtotime($request->dataNascimento)),
                'cpf' => $request->cpf,
                'matricula'=>$request->matricula
            ]);
            //ENVIAR EMAIL
//            Mail::send(new SenhaTemporaria($user->email, $password));
            //MATA O TOKEN PARA NÃO DAR ERRO DE DUPLICIDADE
            $request->session()->regenerateToken();
            DB::commit();
            return redirect()->back()->with(['type' => 'success', 'message' => 'Servidor cadastrado com sucesso!']);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'message' => 'Erro ao cadastrar Servidor!']);
        }
    }

    public function generatePassword($qtyCaraceters = 8)
    {
        //Letras minúsculas embaralhadas
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');

        //Letras maiúsculas embaralhadas
        $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');

        //Números aleatórios
        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;

        //Caracteres Especiais
        $specialCharacters = str_shuffle('!@#$%*-');

        //Junta tudo
        $characters = $capitalLetters . $smallLetters . $numbers . $specialCharacters;

        //Embaralha e pega apenas a quantidade de caracteres informada no parâmetro
        $password = substr(str_shuffle($characters), 0, $qtyCaraceters);

        //Retorna a senha
        return $password;
    }

    public function edit($id)
    {
        $servidor = Servidor::findOrFail($id);
        return view('admin.servidor.edit', compact('servidor'));
    }

    public function update(Request $request, $id)
    {
        try {
            $servidor = Servidor::findOrFail($id);
            DB::beginTransaction();
            $servidor->update([
                'data_nascimento' => date('Y-m-d', strtotime($request->dataNascimento)),
                'cpf' => $request->cpf,
                'matricula'=>$request->matricula
            ]);
            $servidor->user()->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            DB::commit();
            $request->session()->regenerateToken();
            return redirect()->back()->with(['type' => 'success', 'message' => 'Usuário atualizado com sucesso!']);
        } catch (Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'message' => 'Erro ao atualizar usuário!']);
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            Servidor::findOrFail($id)->ForceDelete();
            DB::commit();
            return redirect()->back()->with(['type' => 'success', 'message' => 'Cadastro do Servidor excluído com sucesso!']);
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->with(['type' => 'error', 'message' => 'Erro ao excluir cadastro do Servidor!']);
        }
    }
}
