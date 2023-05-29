@extends('layouts.dashboard.app')

@section('content')
    <style>
        .float-left {
            float: left;
        }

        .float-right {
            float: right;
        }

        .col-sm-6, .col-sm-12 {
            padding-right: 0px;
            padding-left: 0px;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .servidor-container {
            width: 50%;
            /*border: solid 1px white;*/
            padding: 10px;
        }

        .vertical-line {
            height: 0.1px;
            width: 100%; /* Define a altura total da tela */
            background-color: #fff; /* Define a cor de fundo como branca */
        }

        @media (max-width: 650px) {
            .float-right {
                width: 100%;
            }

            .btn {
                width: 100%;
            }
        }
    </style>

    <div class="clearfix">
        <div class="float-left">
            <h3  style="padding-left:20px; color: #2d91cb;"><b>{{ucwords(strtolower($departamento->nomeDepartamento))}}</b></h3>
        </div>
        <div class="float-right" style="padding-right: 20px;padding-left: 10px;">
            <a href="{{route('tarefa.create', $departamento->id)}}" class="btn btn-primary">
                <span class="material-symbols-outlined align-middle">add</span>Nova Tarefa
            </a>
        </div>
    </div>
    <br>
    <div class="container-fluid shadow" style="
            /*background: rgb(45,145,203);*/
            /*background: linear-gradient(38deg, rgba(45,145,203,1) 33%, rgba(42,139,197,1) 37%, rgba(39,136,194,1) 38%, rgba(26,122,178,1) 59%, rgba(18,107,162,1) 90%, rgba(13,98,153,1) 95%, rgba(13,98,153,1) 95%, rgba(44,134,194,1) 100%, rgba(90,188,255,1) 100%);*/
           background: white;
            padding-top: 20px;
            width: 98%;
            height: 75%;
            /*border: solid 4px white;*/
            border-radius: 7px;">

        @foreach($servidores as $servidor)
            <div class="servidor-container float-left">

                <h3 class="text-primary border-bottom border-primary ">{{$servidor->user->name}}</h3>

                <div class="">
                    <div class=" ">
                        {{-- TAREFAS EM BACKLOG --}}
                        <div class="card col-sm-6 float-left">
                            <div id="accordion{{$servidor->user->id}}_backlog">
                                <div class="card-header bg-gradient-danger text-white" data-toggle="collapse"
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
                                                    <div
                                                        class="card {{ $tarefa->classificacao == 0 ? 'bg-success' : ($tarefa->classificacao == 1 ? 'bg-warning'  : 'bg-danger') }}">
                                                        <div class="card-body text-white" data-toggle="collapse"
                                                             data-target="#collapse{{$servidor->user->id}}_tarefa_{{$tarefa->id}}"
                                                             aria-expanded="true"
                                                             aria-controls="collapse{{$servidor->user->id}}_tarefa_{{$tarefa->id}}">
                                                            {{$tarefa->nomeTarefa}}
                                                            <span style="float: right;"
                                                                  class="material-symbols-outlined"> arrow_drop_down</span>
                                                        </div>
                                                    </div>
                                                    <div id="collapse{{$servidor->user->id}}_tarefa_{{$tarefa->id}}"
                                                         class="collapse"
                                                         aria-labelledby="heading{{$servidor->user->id}}_tarefa_{{$tarefa->id}}"
                                                         data-parent="#accordion{{$servidor->user->id}}_{{$tarefa->id}}">
                                                        <div class="card-body border">
                                                            <p class="mb-1"><b>Sobre a
                                                                    Tarefa:</b> {{$tarefa->descricao}}</p>
                                                            <p class="mb-1"><b>Atualizar Tarefa:</b> <a
                                                                    href="{{route('departamento.edit', $departamento->id)}}">
                                                                    <a href="{{route('tarefas.edit', $tarefa->id)}}">
                                                                        <span class="material-symbols-outlined">edit_note</span>
                                                                    </a>
                                                            </p>
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
                        <div class="card col-sm-6 float-right">
                            <div id="accordion{{$servidor->user->id}}_doing">
                                <div class="card-header bg-warning text-white" data-toggle="collapse"
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
                                                            <p class="mb-1"><b>Atualizar Tarefa:</b> <a
                                                                    href="{{route('departamento.edit', $departamento->id)}}">
                                                                    <a href="{{route('tarefas.edit', $tarefa->id)}}">
                                                                        <span class="material-symbols-outlined">edit_note</span>
                                                                    </a>
                                                            </p>
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
                    {{-- TAREFAS EM CODE REVIEW --}}
                    <div class="card col-sm-12">
                        <div id="accordion{{$servidor->user->id}}_code_review">
                            <div class="card-header bg-success text-white" data-toggle="collapse"
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
                                                        <p class="mb-1"><b>Atualizar Tarefa:</b> <a
                                                                href="{{route('departamento.edit', $departamento->id)}}">
                                                                <a href="{{route('tarefas.edit', $tarefa->id)}}">
                                                                    <span
                                                                        class="material-symbols-outlined">edit_note</span>
                                                                </a>
                                                        </p>
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
        @endforeach
        <br>
    </div>
@endsection



