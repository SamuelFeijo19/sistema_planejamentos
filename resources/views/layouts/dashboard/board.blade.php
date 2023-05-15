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
                    <div class="card">

{{--                    TAREFAS EM BACKLOG--}}
                        <div class="card-header bg-primary text-white">
                            Backlog
                        </div>
                        <br>
                        @foreach($tarefas as $tarefa)
                            @if($tarefa->criador_id==$servidor->user->id)
                                    @if($tarefa->situacao == 0)
                                    <div class="card-body shadow-sm">
                                        <div class="card {{ $tarefa->classificacao == 0 ? 'bg-success' : ($tarefa->classificacao == 1 ? 'bg-warning'  : 'bg-danger') }}">
                                            <div class="card-body text-white"> {{$tarefa->nomeTarefa}}
                                                <span style="float: right;" class="material-symbols-outlined"> arrow_drop_down
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                            @endif
                        @endforeach
                    </div>
                        <div class="card">
                                <h5 class="mb-0">
                                        <div class="card-header bg-success text-white">
                                            Doing
                                        </div>
                                </h5>
{{--                        TAREFAS EM ANDAMENTO--}}

                            <br>
                            @foreach($tarefas as $tarefa)
                              @if($tarefa->criador_id==$servidor->user->id)
                                  @if($tarefa->situacao == 1)
                                        <div class="card-body shadow-sm">
                                            <div class="card {{ $tarefa->classificacao == 0 ? 'bg-success' : ($tarefa->classificacao == 1 ? 'bg-warning'  : 'bg-danger') }}">
                                                <div class="card-body text-white"> {{$tarefa->nomeTarefa}}
                                                    <span style="float: right;" class="material-symbols-outlined"> arrow_drop_down
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                @endif
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
                            @if($tarefa->criador_id==$servidor->user->id)
                                @if($tarefa->situacao == 2)
                                    <div class="card-body shadow-sm">
                                        <div class="card {{ $tarefa->classificacao == 0 ? 'bg-success' : ($tarefa->classificacao == 1 ? 'bg-warning'  : 'bg-danger') }}">
                                            <div class="card-body text-white"> {{$tarefa->nomeTarefa}}
                                                <span style="float: right;" class="material-symbols-outlined"> arrow_drop_down
                                                </span>
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
    @endforeach
@endsection
@push('js')

@endpush
