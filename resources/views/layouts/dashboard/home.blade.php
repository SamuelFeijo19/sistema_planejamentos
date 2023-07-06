@extends('layouts.dashboard.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/dashboard/home.css')}}">

    {{--  ÍCONE PARA EXPANDIR AS MÉTRICAS NA VERSAO MOBILE --}}
    <div class="mobile-menu-icon text-primary" style="float: right;" onclick="toggleMenu()">
        <i class="fa fa-bars"></i>
    </div>

    <div style="float: right;" class="sidebarTasks expanded" id="sidebarTasks">
        <h3 style="margin-left: 20px; margin-top: 25px; margin-bottom: 17px;">
            <i class="fa fa-line-chart"></i>
            Métricas
        </h3>
        <div class="col">
            @include('components.cards.OpenTasksCard', ['countTarefasAbertas' => $countTarefasAbertas])
            @include('components.cards.ClosedTasksCard', ['countTarefasfechadas' => $countTarefasfechadas])
            @include('components.cards.HighPriorityTasksCard', ['countTarefasUrgentes' => $countTarefasUrgentes])
            @include('components.cards.ProgressCard', ['porcentagemAndamento' => $porcentagemAndamento])
        </div>
    </div>
    <br>

    <h3 style="margin-left: 20px;">
        <i class="fa fa-trello text-primary"></i>
        Meus Quadros de Tarefas
    </h3>
    <div class="row justify-content-center align-items-center ">
        <div class="col text-center">
            @if($departamentos->isEmpty() && $divisoes->isEmpty())
                <img src="{{ asset('./img/error.png') }}">
            @endif
        </div>
    </div>

    {{-- IMPRESSAO DOS QUADROS DE TAREFAS --}}
    <div class="row" style="margin: 10px;">
        @foreach($departamentos->concat($divisoes) as $item)
            @php
                $route = $item instanceof App\Models\DepartamentoServidor ? 'boardDepartamento.index' : 'boardDivisao.index';
                $id = $item instanceof App\Models\DepartamentoServidor ? $item->departamento->id : $item->divisao->id;
                $nome = $item instanceof App\Models\DepartamentoServidor ? $item->departamento->nomeDepartamento : $item->divisao->nomeDivisao;
            @endphp

            @include('components.quadros.quadroTarefa', compact('item', 'route', 'nome', 'id'))
        @endforeach
    </div>

    <h3 style="margin-left: 20px;">
        <i class="fa fa-bar-chart text-primary"></i>
        Gráficos
    </h3>
    <div class="container-fluid">
        <div class="row">
            <div class="card-body col-md-6">
                <h3>Departamentos</h3>
                <canvas class="shadow" id="myChart"></canvas>
            </div>
            <div class="card-body col-md-6">
                <h3>Divisões</h3>
                <canvas class="shadow" id="myChart1"></canvas>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        {{-- INICIO DO GRAFICO DOS DEPARTAMENTO --}}
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
        }); {{-- FIM DO GRAFICO DOS DEPARTAMENTO --}}

        {{-- INICIO DO GRAFICO DAS DIVISOES --}}
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
        }); {{-- FIM DO GRAFICO DAS DIVISOES --}}

        {{-- INICIO DA FUNCIONALIDADE DE IMAGENS DOS QUADROS --}}
        var images = [
            '{{ asset('./img/cards-bg/card-bg1.png') }}',
            '{{ asset('./img/cards-bg/card-bg3.webp') }}',
            '{{ asset('./img/cards-bg/card-bg4.webp') }}',
            '{{ asset('./img/cards-bg/card-bg5.webp') }}',
            '{{ asset('./img/cards-bg/card-bg5.webp') }}',
            '{{ asset('./img/cards-bg/card-bg6.webp') }}',
            '{{ asset('./img/cards-bg/card-bg7.webp') }}'
        ];

        var usedImages = [];

        @foreach($departamentos->concat($divisoes) as $item)
        @php
            $itemId = $item->id;
            $cardId = 'card-' . $itemId;
            $index = 'index_' . $itemId;
        @endphp

        var cardId_{{$itemId}} = '{{$cardId}}';
        var index_{{$itemId}};

        function changeBackground_{{$itemId}}() {
            var card = document.getElementById(cardId_{{$itemId}});
            card.style.transition = 'background-image 2s ease';

            var newIndex;

            // Encontra um novo índice que não tenha sido usado anteriormente
            do {
                newIndex = Math.floor(Math.random() * images.length);
            } while (usedImages.includes(newIndex));

            // Armazena o novo índice na lista de índices usados
            usedImages.push(newIndex);

            // Verifica se a lista de índices usados está cheia
            if (usedImages.length === images.length) {
                // Se estiver cheia, esvazia a lista para permitir a repetição das imagens
                usedImages = [];
            }

            card.style.backgroundImage = 'url(' + images[newIndex] + ')';
        }

        setInterval(changeBackground_{{$itemId}}, 4000);
        @endforeach
        {{-- FIM DA FUNCIONALIDADE DE IMAGENS DOS QUADROS --}}

        {{-- INICIO DA FUNCIONALIDADE DE EXPANDIR MENU DE MÉTRICAS --}}
        function toggleMenu() {
            $(".sidebarTasks").slideToggle(); // Alterna a exibição do menu lateral
        }

        // Verifica o tamanho da janela ao carregar a página
        window.onload = function () {
            checkWindowSize();
        };

        // Verifica o tamanho da janela ao redimensionar
        window.onresize = function () {
            checkWindowSize();
        };

        // Verifica o tamanho da janela e exibe/oculta o menu lateral conforme necessário
        function checkWindowSize() {
            var sidebarTasks = document.getElementById("sidebarTasks");
            var mobileMenuIcon = document.querySelector(".mobile-menu-icon");

            if (window.innerWidth <= 768) {
                // Dispositivo móvel
                sidebarTasks.style.display = "none"; // Oculta o menu lateral
                mobileMenuIcon.style.display = "block"; // Exibe o ícone do menu
            } else {
                // Tela maior
                sidebarTasks.style.display = "block"; // Exibe o menu lateral
                mobileMenuIcon.style.display = "none"; // Oculta o ícone do menu
            }
        } {{-- FIM DA FUNCIONALIDADE DE EXPANDIR MENU DE MÉTRICAS --}}
    </script>
@endpush
