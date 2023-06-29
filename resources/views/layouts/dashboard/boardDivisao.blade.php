@extends('layouts.dashboard.app')

@section('content')
    <link rel="stylesheet" href="{{asset('js/jquery-ui-1.13.2/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/divisao/board.css')}}">

    <div class="container-fluid shadow" style="
           background: white;
            padding-top: 20px;
            padding-bottom: 20px;
            width: 98%;
            min-height: 90%;
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

        <div class="container col-sm-12 ">
            <div class="row">
                @foreach($servidores as $servidor)
                    <div class="servidor-container shadow col-sm-5">
                        <h4 style="padding: 5px; margin-left: 10px;">{{$servidor->user->name}}</h4>
                        <div class="board">

                            {{-- TAREFAS EM BACKLOG --}}
                            <div class="backlog col-sm-6 float-left">
                                <div class="col-md-6 text-dark list-title list-text-backlog" style="min-height: 25px;">
                                    Backlog
                                </div>
                                <div class="list float-left w-100 h-75" data-situacao="0">
                                    @foreach($tarefas as $tarefa)
                                        @if($tarefa->criador_id==$servidor->user->id)
                                            @if($tarefa->situacao == 0)
                                                @if($tarefa->classificacao == 0)
                                                    <div class="card-item row tarefas"
                                                         data-task-id="{{ $tarefa->id }}">
                                                        <span class="badge badge-xs badge-baixa">Baixa</span>
                                                        <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }} text-dark"
                                                           href="#" draggable="true"
                                                           data-task-id="{{ $tarefa->id }}"
                                                        >{{ $tarefa->nomeTarefa }}
                                                        </a>
                                                    </div>
                                                @elseif($tarefa->classificacao == 1)
                                                    <div class="card-item row"
                                                         data-task-id="{{ $tarefa->id }}">
                                                        <span class="badge badge-xs badge-media">Média</span>
                                                        <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }} text-dark"
                                                           href="#" draggable="true"
                                                           data-task-id="{{ $tarefa->id }}"
                                                        >{{ $tarefa->nomeTarefa }}
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="card-item row"
                                                         data-task-id="{{ $tarefa->id }}">
                                                        <span class="badge badge-xs badge-alta">Alta</span>
                                                        <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }} text-dark"
                                                           href="#" draggable="true"
                                                           data-task-id="{{ $tarefa->id }}"
                                                        >{{ $tarefa->nomeTarefa }}
                                                        </a>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                                <br>
                            </div>

                            {{-- TAREFAS EM ANDAMENTO --}}
                            <div class="doing col-sm-6 float-left "
                                 style="border: 1px;border-radius:25px; border-color: #40C7A4">
                                <div class="col-md-4 text-dark list-title list-text-doing" style=" min-height: 25px;">
                                    Doing
                                </div>
                                <div class="list float-left w-100 h-75" data-situacao="1">
                                    @foreach($tarefas as $tarefa)
                                        @if($tarefa->criador_id==$servidor->user->id)
                                            @if($tarefa->situacao == 1)
                                                @if($tarefa->classificacao == 0)
                                                    <div class="card-item row"
                                                         data-task-id="{{ $tarefa->id }}">
                                                        <span class="badge badge-xs badge-alta">Alta</span>
                                                        <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }} text-dark"
                                                           href="#" draggable="true"
                                                           data-task-id="{{ $tarefa->id }}"
                                                        >{{ $tarefa->nomeTarefa }}
                                                        </a>
                                                    </div>
                                                @elseif($tarefa->classificacao == 1)
                                                    <div class="card-item row"
                                                         data-task-id="{{ $tarefa->id }}">
                                                        <span class="badge badge-xs badge-media">Média</span>
                                                        <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }} text-dark"
                                                           href="#" draggable="true"
                                                           data-task-id="{{ $tarefa->id }}"
                                                        >{{ $tarefa->nomeTarefa }}
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="card-item row"
                                                         data-task-id="{{ $tarefa->id }}">
                                                        <span class="badge badge-xs badge-baixa">Baixa</span>
                                                        <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }} text-dark"
                                                           href="#" draggable="true"
                                                           data-task-id="{{ $tarefa->id }}"
                                                        >{{ $tarefa->nomeTarefa }}
                                                        </a>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            {{-- TAREFAS EM CODE REVIEW --}}
                            <div class="code-review col-sm-12 float-left mt-2 mb-2 ">
                                <div class="text-dark list-title list-text-code-review " style="; height: 25px;">
                                    Code Review
                                </div>
                                <div class="list float-right w-100 h-75" data-situacao="2">
                                    @foreach($tarefas as $tarefa)
                                        @if($tarefa->criador_id==$servidor->user->id)
                                            @if($tarefa->situacao == 2)
                                                @if($tarefa->classificacao == 0)
                                                    <div class="card-item row h-25"
                                                         data-task-id="{{ $tarefa->id }}">
                                                        <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }} text-dark"
                                                           href="#" draggable="true"
                                                           data-task-id="{{ $tarefa->id }}"
                                                        >{{ $tarefa->nomeTarefa }}
                                                        </a>
                                                        <span class="badge badge-xs badge-alta">Alta</span>
                                                    </div>
                                                @elseif($tarefa->classificacao == 1)
                                                    <div class="card-item row"
                                                         data-task-id="{{ $tarefa->id }}">
                                                        <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }} text-dark"
                                                           href="#" draggable="true"
                                                           data-task-id="{{ $tarefa->id }}"
                                                        >{{ $tarefa->nomeTarefa }}
                                                        </a>
                                                        <span class="badge badge-xs badge-media">Média</span>
                                                    </div>
                                                @else
                                                    <div class="card-item row"
                                                         data-task-id="{{ $tarefa->id }}">
                                                        <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }} text-dark"
                                                           href="#" draggable="true"
                                                           data-task-id="{{ $tarefa->id }}"
                                                        >{{ $tarefa->nomeTarefa }}
                                                        </a>
                                                        <span class="badge badge-xs badge-baixa">Baixa</span>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                @endforeach
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-center">
                        <div class="text-white font-weight-bold w-100">
                            DADOS DA TAREFA
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close">
                            X
                        </button>
                    </div>
                    <div class="modal-body" id="taskDetails">

                    </div>
                    {{--                <a class="btn btn-primary w-25" style="margin-left: 74%;margin-bottom: 10px;" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Editar</a>--}}
                </div>
            </div>
        </div>
        <!-- Modal -->

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
                            console.log(taskId, situacao)
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
