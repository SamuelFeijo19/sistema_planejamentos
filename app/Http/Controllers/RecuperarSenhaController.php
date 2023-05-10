<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmaRecuperacaoSenhaRequest;
use App\Http\Requests\RecuperarSenhaRequest;
use App\Mail\RecuperacaoDeSenha;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RecuperarSenhaController extends Controller
{
    public function create()
    {
        return view('usuario.recuperar-senha');
    }

    public function submitForgetPasswordForm(RecuperarSenhaRequest $request)
    {
        try {
        $token = Str::random(64);
        $usuario = new \stdClass();
        $usuario->email = $request->email;
        $usuario->nome = 'ANDERSON ARAUJO FERREIRA';


        //VERIFICAR SE JÁ EXISTE UM TOKEN
        $passwordReset = DB::table('password_resets')->where('email', $request->email)->first();
        DB::beginTransaction();
        if ($passwordReset) {
            $token = $passwordReset->token;
        } else {
            $passwordReset = DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }

        DB::commit();
        $request->session()->regenerateToken();
//        return new RecuperacaoDeSenha($usuario, $token);
        Mail::send(new RecuperacaoDeSenha($usuario, $token));
        return redirect()->route('login')->with(['type' => 'success', 'message' => 'Email enviado com sucesso', 'title' => 'Sucesso!']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('recuperar-senha')->with(['type' => 'error', 'message' => 'Erro ao enviar email', 'title' => 'Erro!']);
        }
    }

    public function resetPassword($token)
    {
        $passwordReset = DB::table('password_resets')->where('token', $token)->first();
        if (!$passwordReset) {
            return redirect()->route('recuperar-senha')->with('error', 'Token inválido');
        }
        return view('usuario.resetar-senha', ['token' => $token]);
    }

    public function confirmResetPassword(ConfirmaRecuperacaoSenhaRequest $request)
    {
        try {
            $updatePassword = DB::table('password_resets')
                ->where([
                    'email' => $request->email,
                    'token' => $request->token
                ])
                ->first();

            if (!$updatePassword) {
                return back()->withInput()->with('error', 'Invalid token!');
            }
            DB::beginTransaction();
            $user = User::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);

            DB::table('password_resets')->where(['email' => $request->email])->delete();
            DB::commit();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with(['type' => 'success', 'message' => 'Senha alterada com sucesso', 'title' => 'Sucesso!']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('login')->with(['type' => 'error', 'message' => 'Erro ao alterar senha', 'title' => 'Erro!']);
        }
    }
}
