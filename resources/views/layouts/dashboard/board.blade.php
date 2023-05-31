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
            width: 49%;
            /*border: solid 1px white;*/
            padding: 10px;
            background: #FFFFFF;
            border-radius: 20px;
            margin: 5px;
        }

        .vertical-line {
            height: 0.1px;
            width: 100%; /* Define a altura total da tela */
            background-color: #fff; /* Define a cor de fundo como branca */
        }

        .text {
            position: relative;
            display: inline-block;
            color: #6b6d7d;
        }

        .text1 {
            position: relative;
            display: inline-block;
            color: #2e59d9;
        }

        .text1::after{
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            height: 2px;
            background-color: #2e59d9; /* Cor do sublinhado */
        }

        .text::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            height: 2px;
            background-color: #6b6d7d; /* Cor do sublinhado */
        }

        a{
            text-decoration: none;
        }
        @media (max-width: 650px) {
            .float-right {
                width: 100%;
            }

            .btn {
                width: 100%;
            }

            .servidor-container{
                width: 100%;
            }
        }
    </style>

    <div class="container-fluid shadow" style="
            /*background: rgb(45,145,203);*/
            /*background: linear-gradient(38deg, rgba(45,145,203,1) 33%, rgba(42,139,197,1) 37%, rgba(39,136,194,1) 38%, rgba(26,122,178,1) 59%, rgba(18,107,162,1) 90%, rgba(13,98,153,1) 95%, rgba(13,98,153,1) 95%, rgba(44,134,194,1) 100%, rgba(90,188,255,1) 100%);*/
           background: #ccc;
            padding-top: 20px;
            width: 98%;
            height: 90%;
            /*border: solid 4px white;*/
            border-radius: 7px;">
        <div class="clearfix">
            <div class="float-left">
                <h3  style="padding-left:30px; color: #2d91cb;"><b>{{ucwords(strtolower($departamento->nomeDepartamento))}}</b></h3>
            </div>
            <div class="float-right" style="padding-right: 20px;padding-left: 10px;">
                <a href="{{route('tarefa.create', $departamento->id)}}" class="btn btn-primary">
                    <span class="material-symbols-outlined align-middle">add</span>Nova Tarefa
                </a>
            </div>
        </div>
        <br>
        @foreach($servidores as $servidor)
            <div class="servidor-container float-left">

                <h4 style="padding: 10px; margin-left: 10px;">{{$servidor->user->name}}</h4>

                <div class="">
                    <div class=" ">
                        {{-- TAREFAS EM BACKLOG --}}
                        <div class="col-sm-6 float-left" style=" height: 210px; width: 300px;margin-right: 5px; margin-top:5px;">
                                <div class="border-bottom col-md-1 text-dark" style="border-radius: 10px; height: 50px;">
                                    Backlog
                                </div>

                            @foreach($tarefas as $tarefa)
                                @if($tarefa->criador_id==$servidor->user->id)
                                    @if($tarefa->situacao == 0)
                                        <div class="float-left" style="margin-left: 20px; margin-right: 5px;">
                                            <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }}" href="{{ route('tarefa.show', ['tarefa_id' => $tarefa->id]) }}">{{ $tarefa->nomeTarefa }}</a>
                                                    </div>
                                    @endif
                                @endif
                            @endforeach
                            <br>
                        </div>

                        {{-- TAREFAS EM ANDAMENTO --}}
                        <div class="col-sm-6 float-left" style="border-radius: 10px;height: 210px; margin-top:5px;width:305px;">
                                <div class="col-md-1 text-dark" style="border-radius: 10px; height: 50px;">
                                    Doing
                                </div>
                            @foreach($tarefas as $tarefa)
                                @if($tarefa->criador_id==$servidor->user->id)
                                    @if($tarefa->situacao == 1)
                                        <div class="col float-left" style="margin-left: 20px; margin-right: 5px;">
                                                        <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }}" href="{{ route('tarefa.show', ['tarefa_id' => $tarefa->id]) }}">{{ $tarefa->nomeTarefa }}</a>
                                                    </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                    {{-- TAREFAS EM CODE REVIEW --}}
                    <div class="col-sm-12 float-left position-relative" style="border-radius: 10px;height: 200px; margin-top: 5px;">
                        <div class="m-md-2 text-dark" style="border-radius: 10px; height: 50px;">
                            Code Review
                        </div>
                        @foreach($tarefas as $tarefa)
                            @if($tarefa->criador_id==$servidor->user->id)
                                @if($tarefa->situacao == 2)
                                    <div class="float-left" style="margin-left: 20px; margin-right: 5px;">
                                        <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }}" href="{{ route('tarefa.show', ['tarefa_id' => $tarefa->id]) }}">{{ $tarefa->nomeTarefa }}</a>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                        <a href="#" class="text1 position-absolute" style="bottom: 15px; right: 25px;">Ver Mais</a>
                    </div>
                </div>
            </div>
        @endforeach
        <br>
    </div>
@endsection
