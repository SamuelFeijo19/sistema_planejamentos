@extends('layouts.dashboard.app')

@section('content')
<h3 style="padding-left: 20px;">{{ucwords(strtolower($departamento->nomeDepartamento))}}</h3>

<div class="container-fluid mt-4 shadow-lg" style="
                background: #858796;
                padding-top: 20px;
                width: 90%;
                border-radius: 10px;
                ">

    @foreach($servidores as $servidor)
        <h3 class="text-light">{{$servidor->user->name}}</h3>
        <div class="row">
            <div class="col">
                <div class="card-columns ">
                    <div class="card">

{{--                    TAREFAS EM BACKLOG--}}
                        <div class="card-header bg-primary text-white">
                            Backlog
                        </div>
                        <br>
                        @foreach($tarefas as $tarefa)
                            @if($tarefa->criador_id==$servidor->id)
                                    @if($tarefa->situacao == 0)
                                    <div class="card-body shadow-sm">
                                        <div class="card">
                                            <div class="card-body">
                                                {{$tarefa->nomeTarefa}}
                                                <span style="float: right;" class="material-symbols-outlined">
                                                    arrow_drop_down
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                            @endif
                        @endforeach
                    </div>

                    <div class="card">
{{--                    TAREFAS EM ANDAMENTO--}}
                        <div class="card-header bg-success text-white">
                            Doing
                        </div>
                        <br>
                        @foreach($tarefas as $tarefa)
                            @if($tarefa->situacao == 1)
                                <div class="card-body shadow-sm">
                                    <div class="card">
                                        <div class="card-body">
                                            {{$tarefa->nomeTarefa}}
                                            <span style="float: right;" class="material-symbols-outlined">
                                                    arrow_drop_down
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="card">
{{--                    TAREFAS EM CODE REVIEW--}}
                        <div class="card-header bg-danger text-white">
                            Code Review
                        </div>
                        <br>
                        @foreach($tarefas as $tarefa)
                            @if($tarefa->situacao == 2)
                                <div class="card-body shadow-sm">
                                    <div class="card">
                                        <div class="card-body">
                                            {{$tarefa->nomeTarefa}}
                                            <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
        <br>
    @endforeach
</div>
@endsection
