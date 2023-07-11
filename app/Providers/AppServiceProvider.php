<?php

namespace App\Providers;

use App\Models\DepartamentoTarefa;
use App\Models\DivisaoTarefa;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        view()->composer('layouts.dashboard.app', function ($view) {
            $tarefasEmAtrasoDepartamento = DepartamentoTarefa::whereDate('data_conclusao_prevista', '<', now())
                ->where('data_conclusao', '=', null)
                ->whereIn('criador_id', [auth()->user()->id])
                ->get();

            $tarefasEmAtrasoDivisao = DivisaoTarefa::whereDate('data_conclusao_prevista', '<', now())
                ->where('data_conclusao', '=', null)
                ->whereIn('criador_id', [auth()->user()->id])
                ->get();

            $tarefasEmAtraso = $tarefasEmAtrasoDepartamento->concat($tarefasEmAtrasoDivisao);

            $view->with('tarefasEmAtraso', $tarefasEmAtraso);
        });
    }

}
