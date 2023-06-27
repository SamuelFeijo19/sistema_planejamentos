@extends('layouts.dashboard.app')

@section('content')
    <link rel="stylesheet" href="{{asset('js/jquery-ui-1.13.2/jquery-ui.min.css')}}">
    <style>
        .float-left {
            float: left;
        }

        .float-right {
            float: right;
        }

        .col-sm-6, .col-sm-12 {
            padding-right: 2px;
            padding-left: 2px;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .servidor-container {
            width: 45%;
            /*border: solid 1px white;*/
            padding: 10px;
            background: #FFFFFF;
            border-radius: 20px;
            margin: 20px;
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

        .text::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 100%;
            height: 2px;
            background-color: #6b6d7d; /* Cor do sublinhado */
        }

        a {
            text-decoration: none;
        }

        @media (max-width: 650px) {
            .float-right {
                width: 100%;
            }

            .btn {
                width: 100%;
            }

            .servidor-container {
                width: 100%;
            }
        }


        /*MEU CSS*/
        .board {
            display: flex;
            flex-wrap: wrap;
            height: 400px; /* Altura fixa do board */
        }

        .list {
            flex: 1;
            margin: 0 10px;
            padding: 10px;
            background-color: #f0f0f0;
            border-radius: 10px;
            max-height: 200px; /* Altura máxima para o list com scroll */
            overflow-y: auto; /
        }

        .list-title {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .card-item {
            background-color: #ffffff;
            padding: 10px;
            margin: 0 0 10px 0;
            border-radius: 4px;
            cursor: move;
        }

        .card-item.dragging {
            opacity: 0.5;
        }

        .card-item.drag-over {
            border: 2px dashed #000000;
        }

        .code-review-row {
            flex-basis: 100%;
        }
    </style>

    <div class="container-fluid shadow" style="
           background: #ccc;
            padding-top: 20px;
            width: 98%;
            height: 90%;
            /*border: solid 4px white;*/
            border-radius: 7px;">
        <div class="clearfix">
            <div class="float-left">
                <h3 style="padding-left:30px; color: #2d91cb;">
                    <b>{{ucwords(strtolower($divisao->nomeDivisao))}}</b></h3>
            </div>
            <div class="float-right" style="padding-right: 20px;padding-left: 10px;">
                <a href="{{route('tarefaDivisao.create', $divisao->id)}}" class="btn btn-primary">
                    <span class="material-symbols-outlined align-middle">add</span>Nova Tarefa
                </a>
            </div>
        </div>
        <br>
        @foreach($servidores as $servidor)
            <div class="servidor-container float-left">

                <h4 style="padding: 10px; margin-left: 10px;">{{$servidor->user->name}}</h4>

                <div class="board">

                    {{-- TAREFAS EM BACKLOG --}}
                    <div class="col-sm-6 float-left">
                        <div class="col-md-4 text-dark" style="border-radius: 10px; height: 50px;">
                            Backlog
                        </div>
                        <div class="list float-left w-100" data-situacao="0">
                            @foreach($tarefas as $tarefa)
                                @if($tarefa->criador_id==$servidor->user->id)
                                    @if($tarefa->situacao == 0)
                                        <div class="card-item row" data-task-id="{{ $tarefa->id }}">
                                            <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }} task-link"
                                               href="#" draggable="true" data-task-id="{{ $tarefa->id }}"
                                            >{{ $tarefa->nomeTarefa }}
                                            </a>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <br>
                    </div>

                    {{-- TAREFAS EM ANDAMENTO --}}
                    <div class="col-sm-6 float-left">
                        <div class="col-md-4 text-dark" style="border-radius: 10px; height: 50px;">
                            Doing
                        </div>

                        <div class="list float-left w-100" data-situacao="1">
                            @foreach($tarefas as $tarefa)
                                @if($tarefa->criador_id==$servidor->user->id)
                                    @if($tarefa->situacao == 1)
                                        <div class="card-item row" data-task-id="{{ $tarefa->id }}">
                                            <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }} task-link"
                                               href="#" draggable="true" data-task-id="{{ $tarefa->id }}"
                                            >{{ $tarefa->nomeTarefa }}
                                            </a>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>

                    {{-- TAREFAS EM CODE REVIEW --}}
                    <div class="col-sm-12 float-left mt-2 mb-2">
                        <div class="col-md-4 text-dark" style="border-radius: 10px; height: 50px;">
                            Code Review
                        </div>
                        <div class="list float-left w-100" data-situacao="2">
                            @foreach($tarefas as $tarefa)
                                @if($tarefa->criador_id==$servidor->user->id)
                                    @if($tarefa->situacao == 2)
                                        <div class="card-item row" data-task-id="{{ $tarefa->id }}">
                                            <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }} task-link"
                                               href="#" draggable="true" data-task-id="{{ $tarefa->id }}"
                                            >{{ $tarefa->nomeTarefa }}
                                            </a>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="row w-100 justify-content-end">
                        <a href="#" class="text1">Ver Mais</a>
                    </div>
                </div>
            </div>
        @endforeach
        <br>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-center">
                    <div class="text-white font-weight-bold w-100">
                        DADOS DA TAREFA
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close">
                        X
                    </button>
                </div>
                <div class="modal-body" id="taskDetails">

                </div>
                {{--                <a class="btn btn-primary w-25" style="margin-left: 74%;margin-bottom: 10px;" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Editar</a>--}}
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/jquery-ui-1.13.2/jquery-ui.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.task-link').click(function (e) {
                e.preventDefault();

                var taskId = $(this).data('task-id');

                var url = '{{ route("taskDivisao.details", ":taskId") }}';
                url = url.replace(':taskId', taskId);

                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function (response) {
                        var modalBody = $('#taskModal').find('.modal-body');

                        var prioridade = response.classificacao === 0 ? 'Baixa Prioridade' : (response.classificacao === 1 ? 'Média Prioridade' : 'Alta Prioridade');
                        var situacao = response.situacao === 0 ? 'Backlog' : (response.classificacao === 1 ? 'Doing' : 'Code Review');

                        modalBody.empty();

                        modalBody.append('<p><strong>Nome:</strong> ' + response.nomeTarefa + '</p>');
                        modalBody.append('<p><strong>Descrição:</strong> ' + response.descricao + '</p>');
                        modalBody.append('<p><strong>Classificação:</strong> ' + prioridade + '</p>');
                        modalBody.append('<p><strong>Situação:</strong> ' + situacao + '</p>');
                        modalBody.append('<p><strong>Número do Chamado:</strong> ' + (response.numeroChamado !== null ? response.numeroChamado : 'Não informado') + '</p>');

                        var editButton = '<a class="" href="{{ route("tarefasDivisao.edit", ":taskId") }}"><span class="material-symbols-outlined">edit_note</span></a>';
                        var doneButton = '<a class="" href="{{ route("taskDivisao.updateStatus", ":taskId") }}"><span class="material-symbols-outlined">check_circle</span></a>';

                        editButton = editButton.replace(':taskId', taskId);
                        doneButton = doneButton.replace(':taskId', taskId);

                        var actionsDiv = $('<div>').addClass('d-flex align-items-center');
                        actionsDiv.append(editButton);
                        actionsDiv.append(doneButton);

                        modalBody.append('<p><strong>Ações:</strong></p>');
                        modalBody.append(actionsDiv);

                        $('#taskModal').modal('show');
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });

        $(function () {
            $(".card-item").draggable({
                revert: "invalid",
                connectToSortable: ".list",
                start: function (event, ui) {
                    $(this).addClass("dragging");
                },
                stop: function (event, ui) {
                    $(this).removeClass("dragging");
                    $(this).css({
                        top: 0,
                        left: 0
                    })
                    let card = $(event.target)
                    let situacao = card.closest('.list').data('situacao')
                    let taskId = card.data('task-id')
                    let url = '{{route('task.moveSituacaoDivisao')}}'
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "taskId": taskId,
                            "situacao": situacao
                        },
                        success: function (response) {

                        },
                        error: function (xhr) {
                            swal.fire({
                                title: 'Erro!',
                                text: xhr.responseText,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            })
                        }

                    });
                }
            });

            $(".list").droppable({
                accept: ".card-item",
                connectWith: ".list",
                drop: function (event, ui) {
                    $(this).append(ui.draggable);
                }
            });
        });

    </script>

@endpush
