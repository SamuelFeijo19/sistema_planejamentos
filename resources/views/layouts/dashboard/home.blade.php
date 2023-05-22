@extends('layouts.dashboard.app')

@section('content')
    <div class="container" style="margin: 20px;">
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
