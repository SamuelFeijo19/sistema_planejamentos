@extends('layouts.dashboard.app')

@section('content')
    <h3 style="padding-left: 20px;">Meus Departamentos</h3>
    @foreach($lotacoes as $lotacao)
        <div class="card shadow" style="width: 60%; margin:20px">
            <div class="card-body">
                <h5 class="card-title">{{$lotacao->departamento->nomeDepartamento}}</h5>
                <p class="card-text">Clique abaixo para ir para o quadro de tarefas do seu departamanto</p>
                <a href="{{route('board.index', $lotacao->departamento->id)}}" class="btn btn-primary">Board</a>
            </div>
        </div>
    @endforeach
@endsection
