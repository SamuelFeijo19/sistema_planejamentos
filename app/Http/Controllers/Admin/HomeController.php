<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ModelNotFoundException;
use App\Models\Lotacao;
use App\Models\Servidor;
use App\Models\Departamento;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('layouts.dashboard.app');
    }

    public function content(Request $request)
    {

        $servidorId = auth()->user()->id; // Obtenha o ID do usuário logado na sessão

        $lotacoes = Lotacao::where('servidor_id', $servidorId)->get();

        return view('layouts.dashboard.home', compact('lotacoes'));
    }

//    public function contentUser(Request $request)
//    {
//        return view('layouts.dashboard.contentUser', compact('eventos'));
//    }

}
