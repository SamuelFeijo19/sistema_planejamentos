<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Departamento;

class AdminDptMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $departamentoId = $request->route('id');
        $usuarioId = auth()->user()->servidor->id;

        $departamento = Departamento::find($departamentoId);

        if (!$departamento || $departamento->administrador_id !== $usuarioId) {
            abort(403, 'Acesso negado. Você não é o administrador deste departamento.');
        }

        return $next($request);
    }

}
