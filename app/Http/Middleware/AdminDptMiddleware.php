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
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle($request, Closure $next)
    {
        $departamentoId = $request->route('departamento_id');
        $usuarioId = auth()->user()->servidor->id;

        $departamento = Departamento::find($departamentoId);

        if ($departamento->administrador_id == $usuarioId || auth()->user()->is_admin)
            return $next($request);
        else
            return redirect()->back()->with(['type' => 'error', 'title' => 'Acesso Negado', 'message' => 'Você não é o administrador deste departamento!']);
    }
}
