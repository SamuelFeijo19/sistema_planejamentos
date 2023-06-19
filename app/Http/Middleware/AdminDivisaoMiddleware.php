<?php

namespace App\Http\Middleware;

use App\Models\Departamento;
use App\Models\Divisao;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminDivisaoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $divisaoId = $request->route('divisao_id');
        $usuarioId = auth()->user()->servidor->id;

        $divisao = Divisao::find($divisaoId);

        //OBTER ID DO DEPARTAMENTO
        $cod = $divisao->departamento_id;

        //BUSCAR DEPARTAMENTO
        $departamento= Departamento::where('id', '=', $cod)->first();

        if($departamento->administrador_id == $usuarioId){
            return $next($request);
        }else if($divisao->administrador_id !== $usuarioId ){
            return redirect()->back()->with(['type' => 'error', 'title'=>'Acesso Negado', 'message' => 'Você não é o administrador desta divisão!']);
        }

        return $next($request);
    }

}
