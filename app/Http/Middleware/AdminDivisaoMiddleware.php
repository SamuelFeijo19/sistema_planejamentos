<?php

namespace App\Http\Middleware;

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

        if (!$divisao || $divisao->administrador_id !== $usuarioId) {
            abort(403, 'Acesso negado. Você não é o administrador desta divisão.');
        }

        return $next($request);
    }

}
