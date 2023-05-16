@extends('layouts.dashboard.app')

@section('content')
    <style>
        .float-left {
            float: left;
        }

        .float-right {
            float: right;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        @media (max-width: 650px) {
            .float-right {
                width: 100%;
                padding: 10px;
            }

            .btn {
                width: 100%;
            }
        }
    </style>

    <div class="clearfix">
        <div class="float-left">
            <h3 style="padding-left: 20px;">{{ucwords(strtolower($departamento->nomeDepartamento))}}</h3>
        </div>
        <div class="float-right" style="padding-right: 20px;">
            <a href="{{route('tarefa.create', $departamento->id)}}" class="btn btn-primary">
                <span class="material-symbols-outlined align-middle">add</span>Nova Tarefa
            </a>
        </div>
    </div>

    @foreach($servidores as $servidor)
        <div class="container-fluid mt-4 shadow-lg" style="
                background: #858796;
                padding-top: 20px;
                width: 90%;
                border-radius: 10px;
                ">

            <h3 class="text-light">{{$servidor->user->name}}</h3>
            <div class="row">
                <div class="col">
                    <div class="card-columns ">

                        {{-- TAREFAS EM BACKLOG --}}
                        <div class="card">
                            <div id="accordion{{$servidor->user->id}}_backlog">
                                <div class="card-header bg-primary text-white" data-toggle="collapse"
                                     data-target="#collapse{{$servidor->user->id}}_backlog" aria-expanded="true"
                                     aria-controls="collapse{{$servidor->user->id}}_backlog">
                                    Backlog
                                </div>
                            </div>
                            <br>
                            @foreach($tarefas as $tarefa)
                                @if($tarefa->criador_id==$servidor->user->id)
                                    @if($tarefa->situacao == 0)
                                        <div id="collapse{{$servidor->user->id}}_backlog" class="collapse"
                                             aria-labelledby="heading{{$servidor->user->id}}_backlog"
                                             data-parent="#accordion{{$servidor->user->id}}_backlog">
                                            <div id="accordion{{$servidor->user->id}}_{{$tarefa->id}}">
                                                <div class="card-body shadow-sm">
                                                    <div class="card {{ $tarefa->classificacao == 0 ? 'bg-success' : ($tarefa->classificacao == 1 ? 'bg-warning'  : 'bg-danger') }}">
                                                        <div class="card-body text-white" data-toggle="collapse"
                                                             data-target="#collapse{{$servidor->user->id}}_tarefa_{{$tarefa->id}}"
                                                             aria-expanded="true"
                                                             aria-controls="collapse{{$servidor->user->id}}_tarefa_{{$tarefa->id}}">
                                                            {{$tarefa->nomeTarefa}}
                                                            <span style="float: right;" class="material-symbols-outlined"> arrow_drop_down</span>
                                                        </div>
                                                    </div>
                                                    <div id="collapse{{$servidor->user->id}}_tarefa_{{$tarefa->id}}" class="collapse"
                                                         aria-labelledby="heading{{$servidor->user->id}}_tarefa_{{$tarefa->id}}"
                                                         data-parent="#accordion{{$servidor->user->id}}_{{$tarefa->id}}">
                                                        <div class="card-body border">
                                                            <p class="mb-1"><b>Sobre a Tarefa:</b> {{$tarefa->descricao}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>

                        {{-- TAREFAS EM ANDAMENTO --}}
                        <div class="card">
                            <div id="accordion{{$servidor->user->id}}_doing">
                                <div class="card-header bg-success text-white" data-toggle="collapse"
                                     data-target="#collapse{{$servidor->user->id}}_doing" aria-expanded="true"
                                     aria-controls="collapse{{$servidor->user->id}}_doing">
                                    Doing
                                </div>
                            </div>
                            <br>
                            @foreach($tarefas as $tarefa)
                                @if($tarefa->criador_id==$servidor->user->id)
                                    @if($tarefa->situacao == 1)
                                        <div id="collapse{{$servidor->user->id}}_doing" class="collapse"
                                             aria-labelledby="heading{{$servidor->user->id}}_doing"
                                             data-parent="#accordion{{$servidor->user->id}}_doing">
                                            <div id="accordion{{$servidor->user->id}}_{{$tarefa->id}}">
                                                <div class="card-body shadow-sm">
                                                    <div
                                                        class="card {{ $tarefa->classificacao == 0 ? 'bg-success' : ($tarefa->classificacao == 1 ? 'bg-warning'  : 'bg-danger') }}">
                                                        <div class="card-body text-white" data-toggle="collapse"
                                                             data-target="#collapse{{$servidor->user->id}}_{{$tarefa->id}}"
                                                             aria-expanded="true"
                                                             aria-controls="collapse{{$servidor->user->id}}_{{$tarefa->id}}">
                                                            {{$tarefa->nomeTarefa}}
                                                            <span style="float: right;"
                                                                  class="material-symbols-outlined"> arrow_drop_down</span>
                                                        </div>
                                                    </div>

                                                    <div id="collapse{{$servidor->user->id}}_{{$tarefa->id}}"
                                                         class="collapse"
                                                         aria-labelledby="heading{{$servidor->user->id}}_{{$tarefa->id}}"
                                                         data-parent="#accordion{{$servidor->user->id}}_{{$tarefa->id}}">
                                                        <div class="card-body border">
                                                            <p class="mb-1"><b>Sobre a
                                                                    Tarefa:</b> {{$tarefa->descricao}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>

                        {{-- TAREFAS EM CODE REVIEW --}}
                        <div class="card">
                            <div id="accordion{{$servidor->user->id}}_code_review">
                                <div class="card-header bg-danger text-white" data-toggle="collapse"
                                     data-target="#collapse{{$servidor->user->id}}_code_review" aria-expanded="true"
                                     aria-controls="collapse{{$servidor->user->id}}_code_review">
                                    Code Review
                                </div>
                            </div>
                            <br>
                            @foreach($tarefas as $tarefa)
                                @if($tarefa->criador_id==$servidor->user->id)
                                    @if($tarefa->situacao == 2)
                                        <div id="collapse{{$servidor->user->id}}_code_review" class="collapse"
                                             aria-labelledby="heading{{$servidor->user->id}}_code_review"
                                             data-parent="#accordion{{$servidor->user->id}}_code_review">
                                            <div id="accordion{{$servidor->user->id}}_{{$tarefa->id}}">
                                                <div class="card-body shadow-sm">
                                                    <div
                                                        class="card {{ $tarefa->classificacao == 0 ? 'bg-success' : ($tarefa->classificacao == 1 ? 'bg-warning'  : 'bg-danger') }}">
                                                        <div class="card-body text-white" data-toggle="collapse"
                                                             data-target="#collapse{{$servidor->user->id}}_{{$tarefa->id}}"
                                                             aria-expanded="true"
                                                             aria-controls="collapse{{$servidor->user->id}}_{{$tarefa->id}}">
                                                            {{$tarefa->nomeTarefa}}
                                                            <span style="float: right;"
                                                                  class="material-symbols-outlined"> arrow_drop_down</span>
                                                        </div>
                                                    </div>
                                                    <div id="collapse{{$servidor->user->id}}_{{$tarefa->id}}"
                                                         class="collapse"
                                                         aria-labelledby="heading{{$servidor->user->id}}_{{$tarefa->id}}"
                                                         data-parent="#accordion{{$servidor->user->id}}_{{$tarefa->id}}">
                                                        <div class="card-body border">
                                                            <p class="mb-1"><b>Sobre a
                                                                    Tarefa:</b> {{$tarefa->descricao}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
        <br>
    @endforeach
@endsection



