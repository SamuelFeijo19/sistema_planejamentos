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

    <div class="card container-fluid col-md-11">
        <div class="row">
            <div class="card-body col-md-6" >
                <h3 style="padding-left: 20px;">Departamentos</h3>
                    <canvas class="shadow" id="myChart"></canvas>
            </div>
            <div class="card-body col-md-6">
                <h3 style="padding-left: 20px;">Divisões</h3>
                    <canvas class="shadow" id="myChart1"></canvas>
            </div>
        </div>
    </div>

    <br>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        let labels = [];
        let dataB = [];
        let dataD = [];
        let dataCR = [];

        let backlogCount = 0;
        let doingCount = 0;
        let codeReviewCount = 0;

        @foreach($departamentos as $departamento)
        labels.push("{{$departamento->departamento->nomeDepartamento}}");

        @foreach($departamento->departamento->departamentoTarefas as $departamentoTarefa)
            @if($departamentoTarefa->situacao == 0)
            backlogCount++;
        @elseif($departamentoTarefa->situacao == 1)
            doingCount++;
        @elseif($departamentoTarefa->situacao == 2)
            codeReviewCount++;
        @endif
        @endforeach

        dataB.push(backlogCount);
        dataD.push(doingCount);
        dataCR.push(codeReviewCount);

        backlogCount = 0;
        doingCount = 0;
        codeReviewCount = 0;
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
                        backgroundColor: 'rgba(75, 192, 192, 0.5)', // Verde
                        stack: 'Stack 0'
                    },
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

        let backlogCount1 = 0;
        let doingCount1 = 0;
        let codeReviewCount1 = 0;

        @foreach($divisoes as $divisao)
        labels1.push("{{$divisao->divisao->nomeDivisao}}");

        @foreach($divisao->divisao->divisaoTarefas as $divisaotarefa)
            @if($divisaotarefa->situacao == 0)
            backlogCount1++;
        @elseif($divisaotarefa->situacao == 1)
            doingCount1++;
        @elseif($divisaotarefa->situacao == 2)
            codeReviewCount1++;
        @endif
        @endforeach

        dataB1.push(backlogCount1);
        dataD1.push(doingCount1);
        dataCR1.push(codeReviewCount1);

        backlogCount1 = 0;
        doingCount1 = 0;
        codeReviewCount1 = 0;
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
