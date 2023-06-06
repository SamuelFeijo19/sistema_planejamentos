@extends('layouts.dashboard.app')

@push('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endpush

@section('content')
    <style>
        h3 {
            color: #2d91cb;
            font-weight: bold;
        }
    </style>
    <div class="row" style="margin: 10px;">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="d-flex align-items-center">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Minhas Tarefas Abertas
                                </div>
                                <span class="text-primary material-symbols-outlined ml-2 mb-2">
                                    confirmation_number
                                </span>
                            </div>

                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <div style="float: left;">{{$countTarefasAbertas}} Tarefas</div>
                                </a>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="d-flex align-items-center">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Minhas Tarefas Concluídas
                                </div>
                                <span class="text-success material-symbols-outlined ml-2 mb-2">
                                    check_circle
                                </span>
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$countTarefasfechadas}} Tarefas</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                                             style="width: {{ $porcentagemAndamento }}%" aria-valuenow="{{ $porcentagemAndamento }}"
                                             aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
{{--        <div class="col-xl-3 col-md-6 mb-4">--}}
{{--            <div class="card border-left-warning shadow h-100 py-2">--}}
{{--                <div class="card-body">--}}
{{--                    <div class="row no-gutters align-items-center">--}}
{{--                        <div class="col mr-2">--}}
{{--                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">--}}
{{--                                Pending Requests</div>--}}
{{--                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <i class="fas fa-comments fa-2x text-gray-300"></i>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="card-body col-md-6" >
                <h3 >Departamentos</h3>
                    <canvas class="shadow" id="myChart"></canvas>
            </div>
            <div class="card-body col-md-6">
                <h3 >Divisões</h3>
                    <canvas class="shadow" id="myChart1"></canvas>
            </div>
        </div>
    </div>

    <br>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- GRAFICO DAS DEPARTAMENTO --}}
    <script>
        const ctx = document.getElementById('myChart');

        let labels = [];
        let dataB = [];
        let dataD = [];
        let dataCR = [];
        let dataCONC = [];

        let backlogCount = 0;
        let doingCount = 0;
        let codeReviewCount = 0;
        let concluidoCount = 0;

        @foreach($departamentos as $departamento)
        labels.push("{{$departamento->departamento->nomeDepartamento}}");

        @foreach($departamento->departamento->departamentoTarefas as $departamentoTarefa)
            @if($departamentoTarefa->situacao == 0)
            backlogCount++;
        @elseif($departamentoTarefa->situacao == 1)
            doingCount++;
        @elseif($departamentoTarefa->situacao == 2)
            codeReviewCount++;
        @elseif($departamentoTarefa->situacao == 3)
            concluidoCount++;
        @endif
        @endforeach

        dataB.push(backlogCount);
        dataD.push(doingCount);
        dataCR.push(codeReviewCount);
        dataCONC.push(concluidoCount);

        backlogCount = 0;
        doingCount = 0;
        codeReviewCount = 0;
        concluidoCount = 0;
        @endforeach

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Backlog',
                        data: dataB,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)', // Vermelho
                        stack: 'Stack 0',
                    },
                    {
                        label: 'Doing',
                        data: dataD,
                        backgroundColor: 'rgba(255, 255, 0, 0.5)', // Amarelo
                        stack: 'Stack 0'
                    },
                    {
                        label: 'Code Review',
                        data: dataCR,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)', // Azul
                        stack: 'Stack 0'
                    },
                    {
                        label: 'Concluído',
                        data: dataCONC,
                        backgroundColor: 'rgba(3, 252, 48, 0.5)', // Verde
                        stack: 'Stack 1'
                    }

                ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stacked: true,
                    },
                },
            },
        });
    </script>

    {{-- GRAFICO DAS DIVISOES --}}
    <script>
        const ctx1 = document.getElementById('myChart1');

        let labels1 = [];
        let dataB1 = [];
        let dataD1 = [];
        let dataCR1 = [];
        let dataCONC1 = [];

        let backlogCount1 = 0;
        let doingCount1 = 0;
        let codeReviewCount1 = 0;
        let concluidoCount1 = 0;

        @foreach($divisoes as $divisao)
        labels1.push("{{$divisao->divisao->nomeDivisao}}");

        @foreach($divisao->divisao->divisaoTarefas as $divisaotarefa)
            @if($divisaotarefa->situacao == 0)
            backlogCount1++;
        @elseif($divisaotarefa->situacao == 1)
            doingCount1++;
        @elseif($divisaotarefa->situacao == 2)
            codeReviewCount1++;
        @elseif($divisaotarefa->situacao == 3)
            concluidoCount1++;
        @endif
        @endforeach

        dataB1.push(backlogCount1);
        dataD1.push(doingCount1);
        dataCR1.push(codeReviewCount1);
        dataCONC1.push(concluidoCount1);

        backlogCount1 = 0;
        doingCount1 = 0;
        codeReviewCount1 = 0;
        concluidoCount1 = 0;
        @endforeach

        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: labels1,
                datasets: [
                    {
                        label: 'Backlog',
                        data: dataB1,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)', // Vermelho
                        stack: 'Stack 0',
                    },
                    {
                        label: 'Doing',
                        data: dataD1,
                        backgroundColor: 'rgba(255, 255, 0, 0.5)', // Amarelo
                        stack: 'Stack 0'
                    },
                    {
                        label: 'Code Review',
                        data: dataCR1,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)', // Verde
                        stack: 'Stack 0'
                    },
                    {
                        label: 'Concluído',
                        data: dataCONC1,
                        backgroundColor: 'rgba(3, 252, 48, 0.5)', // Verde
                        stack: 'Stack 1'
                    }
                ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stacked: true,
                    },
                },
            },
        });
    </script>

@endpush
