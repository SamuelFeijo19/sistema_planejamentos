@extends('layouts.dashboard.app')

@section('content')
    <link rel="stylesheet" href="{{asset('js/jquery-ui-1.13.2/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/divisao/board.css')}}">

    <div class="container-fluid shadow" style="
           background: white;
            width: 100%;
            /*min-height: 90%;*/
            background: url({{ asset('img/cards-bg/card-bg7.webp') }}) no-repeat center center fixed;
            background-color: rgba(0,0,0,0.4);
            background-blend-mode: color;
            max-height: 100vh; overflow-y: auto; overflow-x: hidden;
            background-size: cover;
            background-position: center;
            ">

        <div class="clearfix">
            <div class="float-left">
                <h3 class="text-white">
                    <b>{{ucwords(strtolower($departamento->nomeDepartamento))}}</b></h3>
            </div>
            <br><br>

            {{--Componente do Botão de Adicionar--}}
            <x-adicionar.adicionar-button link-route="{{route('tarefasDepartamento.create', $departamento->id)}}"
                                          text-button="Nova Tarefa"/>

            {{--Componente do Botão de Relatórios--}}
            <x-adicionar.relatorio-button link-route="{{route('departamento.relatorio', $departamento->id)}}"/>
        </div>

        {{--Componente do Botão 'Mostrar apenas meu quadro'--}}
        <x-adicionar.on_off link-route="{{route('quadro.alternar.departamento', $departamento->id)}}"/>

        <div class="container col-sm-12 text-white">
            <div class="row">
                @foreach($servidores as $servidor)
                    @if(session('mostrarApenasMeuQuadro') && $servidor->user->id !== auth()->user()->id)
                        @continue
                    @endif
                    <div class="servidor-container shadow col-sm-5 bg-gradient-light text-primary" style="border-radius: 5px;">
                        <h4 style="padding: 5px;">{{$servidor->user->name}}</h4>
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
                                                {{-- COMPONENTE PARA LISTAGEM DE TAREFAS --}}
                                                @include('components.tasks.tasks', ['tarefa' => $tarefa])
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
                                                {{-- COMPONENTE PARA LISTAGEM DE TAREFAS --}}
                                                @include('components.tasks.tasks', ['tarefa' => $tarefa])
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
                                                {{-- COMPONENTE PARA LISTAGEM DE TAREFAS --}}
                                                @include('components.tasks.tasks', ['tarefa' => $tarefa])
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

                        var url = '{{ route("taskDepartamento.details", ":taskId") }}';
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
                                modalBody.append('<p><strong>Data Prevista para Conclusão da Tarefa:</strong> ' + (response.data_conclusao_prevista !== null ? response.data_conclusao_prevista : 'Não informado') + '</p>');

                                var editButton = '<a class="" href="{{ route("tarefasDepartamento.edit", ":taskId") }}"><span class="material-symbols-outlined">edit_note</span></a>';
                                var doneButton = '<a class="" href="{{ route("taskDepartamento.updateStatus", ":taskId") }}"><span class="material-symbols-outlined">check_circle</span></a>';

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
                            let url = '{{route('task.moveSituacao')}}'
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
