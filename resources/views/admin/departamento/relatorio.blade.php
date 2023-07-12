@extends('layouts.dashboard.app')

@section('content')
    <div class="col col-12">
        <h3>Relatórios para o Departamento Teste</h3>
        <hr>
    </div>
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="d-flex align-items-center">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total de Tarefas
                                    </div>
                                    <span class="text-primary material-symbols-outlined ml-2 mb-2">
                            confirmation_number
                        </span>
                                </div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <div style="float: left;">{{$totalTasks}} Tarefas</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="d-flex align-items-center">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total de Tarefas Concluídas
                                    </div>
                                    <span class="text-success material-symbols-outlined ml-2 mb-2">
                                    check_circle
                                </span>
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$closedTasks}} Tarefas</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-md-n5">
                                <div class="d-flex align-items-center">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Total de Tarefas Abertas
                                    </div>
                                    <span class="text-warning material-symbols-outlined ml-2 mb-2">
                            error
                        </span>
                                </div>

                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <div style="float: left;">{{$openTasks}} Tarefas</div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tasks Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="d-flex align-items-center">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Progresso de Tarefas
                                    </div>
                                    <span class="text-info material-symbols-outlined ml-2 mb-2">
                                    rotate_right
                                </span>
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            {{ number_format($porcentagemAndamento, 1) }}%
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                 style="width: {{ $porcentagemAndamento }}%"
                                                 aria-valuenow="{{ $porcentagemAndamento }}"
                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="card" style="width: 60%;">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Relatório Mensal de Tarefas Fechadas</h6>
                </div>
                <canvas id="lineChart"></canvas>
            </div>

            <div class="card" style="width: 38%; margin-left: 10px;">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Situação das Tarefas</h6>
                </div>
                <br><br>
                <div class="">
                    <canvas class="" id="donutChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- GRAFICO --}}
    <!-- Project Card Example -->
    <div class="container-fluid">
        <div class="row">
            <div class="card shadow " style=" width: 60%;">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Status das Tarefas</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Baixa Prioridade<span
                            class="float-right">{{ number_format($porcentBaixaPrioridade, 1) }}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-success" role="progressbar"
                             style="width: {{ $porcentBaixaPrioridade }}%"
                             aria-valuenow="{{ $porcentBaixaPrioridade }}"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Média Prioridade<span
                            class="float-right">{{ number_format($porcentMediaPrioridade, 1) }}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar"
                             style="width: {{ $porcentMediaPrioridade }}%"
                             aria-valuenow="{{ $porcentMediaPrioridade }}"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Alta Prioridade<span
                            class="float-right">{{ number_format($porcentAltaPrioridade, 1) }}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar"
                             style="width: {{ $porcentAltaPrioridade }}%"
                             aria-valuenow="{{ $porcentAltaPrioridade }}"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Tarefas Fechadas<span
                            class="float-right">{{ number_format($porcentTarefasFechadas, 1) }}%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar" role="progressbar" style="width: {{ $porcentTarefasFechadas }}%"
                             aria-valuenow="{{ $porcentTarefasFechadas }}"
                             aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>

            <div class="card" style="width: 38%; margin-left: 10px;">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tarefas em Atraso</h6>
                </div>
                <div style="max-height: 400px; overflow-y: auto; overflow-x: hidden;">
                    <div class="list-group" style="width: 100%;">
                        @foreach($tarefasEmAtraso as $tarefa)
                            <div class="list-group-item shadow-sm m-3 border-left-{{ $tarefa->classificacao == 0 ? 'primary' : ($tarefa->classificacao == 1 ? 'warning' : 'danger') }}">
                                <div class="row">
                                    <div class="col">
                                        <p class="mb-1"><b>Nome: </b>{{ucwords(mb_strtolower($tarefa->nomeTarefa))}}</p>
                                        <p class="mb-1"><b>Descrição: </b>{{ucwords(mb_strtolower($tarefa->descricao))}}</p>
                                        <p class="mb-1"><b>Data Prevista para Conclusão: </b>
                                            {{date('d/m/Y', strtotime($tarefa->data_conclusao_prevista))}}
                                        </p>
                                        <p class="mb-1"><b>Criador da Tarefa: </b>{{ ucwords(mb_strtolower($tarefa->criador->name)) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>

        @endsection

        @push('js')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                // Dados do gráfico
                var data = {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Relatórios Mensais de Tarefas Fechadas',
                        data:
                            [{{$totalTasksByMonth[1]}}, {{$totalTasksByMonth[2]}}, {{$totalTasksByMonth[3]}}, {{$totalTasksByMonth[4]}},
                                {{$totalTasksByMonth[5]}}, {{$totalTasksByMonth[6]}}, {{$totalTasksByMonth[7]}}, {{$totalTasksByMonth[8]}},
                                {{$totalTasksByMonth[9]}}, {{$totalTasksByMonth[10]}}, {{$totalTasksByMonth[11]}}, {{$totalTasksByMonth[12]}}],
                        borderColor: '#36a2eb',
                        backgroundColor: '#b5e8e1',
                        fill: true,
                    }]
                };

                // Opções do gráfico
                var options = {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 10,
                            title: {
                                display: true,
                                text: 'Relatórios'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Mês'
                            }
                        }
                    }
                };

                // Criar o gráfico de linhas
                var ctx = document.getElementById('lineChart').getContext('2d');
                var lineChart = new Chart(ctx, {
                    type: 'line',
                    data: data,
                    options: options
                });


                // Dados do gráfico
                var data = {
                    labels: ['Backlog', 'Doing', 'Code Review'],
                    datasets: [{
                        data: [
                            {{ $backlogTasks }},
                            {{ $doingTasks }},
                            {{ $codeReviewTasks }}
                        ],
                        backgroundColor: ['#ff6384', '#ffce56', '#36a2eb']
                    }]
                };

                // Opções do gráfico
                var options = {
                    responsive: true,
                    maintainAspectRatio: false
                };

                // Criar o gráfico de donuts
                var ctx = document.getElementById('donutChart').getContext('2d');
                var donutChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: data,
                    options: options
                });
            </script>
    @endpush

