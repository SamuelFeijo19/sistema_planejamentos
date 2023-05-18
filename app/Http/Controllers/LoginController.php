<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Lotacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request) {
        return view('login');
    }
     public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $servidorId = auth()->user()->id; // Obtenha o ID do usuário logado na sessão
//            dd($servidorId);
            $lotacoes = Lotacao::where('servidor_id', $servidorId)->get();

            return redirect()->route('dashboard.content', compact('lotacoes'));
        }else{
            return "Login falhou";
        }

        return back()->withErrors([
            'email' => 'As credenciais fornecidas não correspondem aos nossos registros.',
        ])->onlyInput('email');
    }

    public function sair(){
        auth()->logout();
        return redirect()->route('login');

     }
}
