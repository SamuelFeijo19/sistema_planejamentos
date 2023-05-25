@extends('layouts.dashboard.app')

@push('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
@endpush
@section('content')

    <div class="container" style="margin: 20px;">

        <div class="container shadow" style="width: 40%; float: left;">
            <br>
            <h3>RELATÓRIO DE TAREFAS</h3>
            <canvas id="myChart"></canvas>
            <br>
        </div>
        <div class="row">
            <div class="col-md-6" style="border-right: 1px solid #ccc;">
                <h3 style="padding-left: 20px;">Meus Departamentos</h3>
                @foreach($departamentos as $departamento)
                    <div class="card shadow mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{$departamento->departamento->nomeDepartamento}}</h5>
                            <p class="card-text">Clique abaixo para ir para o quadro de tarefas do seu departamento</p>
                            <a href="{{route('board.index', $departamento->departamento->id)}}" class="btn btn-primary">Board</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-6">
                <h3 style="padding-left: 20px;">Minhas Divisões</h3>
                @foreach($divisoes as $divisao)
                    <div class="card shadow mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{$divisao->divisao->nomeDivisao}}</h5>
                            <p class="card-text">Clique abaixo para ir para o quadro de tarefas da sua divisão</p>
                            <a href="{{route('boardDivisao.index', $divisao->divisao->id)}}" class="btn btn-primary">Board</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
                // Função para buscar os dados do servidor
                function getData() {
                    $.ajax({
                        url: '{{ route("dados-tarefas") }}',
                        method: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            // Dados do gráfico
                            var data = {
                                labels: response.labels,
                                datasets: [{
                                    data: response.values,
                                    backgroundColor: response.colors
                                }]
                            };

                            // Configurações do gráfico
                            var options = {
                                responsive: true
                            };

                            // Renderiza o gráfico em pizza
                            var ctx = document.getElementById('myChart').getContext('2d');
                            new Chart(ctx, {
                                type: 'pie',
                                data: data,
                                options: options
                            });
                        },
                        error: function (error) {
                            console.log(error);
                        }
                    });
                }

                // Chamada inicial para buscar os dados e renderizar o gráfico
                getData();
                console.log(data);
            });
    </script>
@endpush
