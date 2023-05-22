@extends('layouts.dashboard.app')

@section('content')
    <div class="container-fluid">
        <div style="width: 100%;">
            <div class="col col-12">
                <h3>Departamentos cadastrados</h3>
                <hr>
            </div>

            @if(isset($mensagem))
                <div class="alert alert-warning" style="width: 300px;">{{ $mensagem }}</div>
            @endif

            <div class="w-100">
                <div class="list-group">
                    @foreach ($departamentos as $departamento)
                        <div class="list-group-item shadow-sm">
                            <div class="row">
                                <div class="col">
                                    <p class="mb-1"><b>Nome do Departamento:</b> {{ucwords(mb_strtolower($departamento->nomeDepartamento))}}</p>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                    <div class="text-right">
                                        <a href="{{route('departamentos.servidor.create', $departamento->id)}}" title="ADICIONAR SERVIDOR">
                                            <span class="material-symbols-outlined text-success">person_add</span>
                                        </a>
                                        <a href="#" class="delete"
                                           data-route="{{route('departamento.destroy', $departamento->id)}}">
                                            <span class="material-symbols-outlined text-danger">delete</span>
                                        </a>
                                        <a href="{{route('departamento.edit', $departamento->id)}}">
                                            <span class="material-symbols-outlined">edit_note</span>
                                        </a>
                                        <a href="{{route('departamentoServidor.index', $departamento->id)}}" title="LISTAR SERVIDORES">
                                            <span class="material-symbols-outlined text-primary">groups</span>
                                        </a>
                                        <a href="{{route('divisao.index', $departamento->id)}}" title="LISTAR DIVISOES">
                                            <span class="material-symbols-outlined text-primary">moving_ministry</span>
                                        </a>
                                        <a href="{{route('board.index', $departamento->id)}}">
                                            <span class="material-symbols-outlined">grid_view</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/delete/delete.js')}}"></script>
@endpush

