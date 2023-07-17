@extends('layouts.dashboard.app')

@section('content')
    <style>
        h3 {
            color: #2d91cb;
            font-weight: bold;
        }
    </style>

    <div class="container-fluid">
        <div style="width: 100%;">
            <div class="col col-12">
                <h3>Divisões do {{ucwords(mb_strtolower($departamento->nomeDepartamento))}}</h3>
                <hr>
            </div>

            {{--Componente do Botão de Adicionar--}}
            <x-adicionar.adicionar-button link-route="{{route('divisao.create', $departamento_id)}}" text-button="Nova Divisão" />

            {{--Componente do Botão de Pesquisa--}}
            <x-search.search-button placeholder="Busque por Divisões ..." form-action="#" />

            @if(isset($mensagem))
                <div class="alert alert-warning" style="width: 300px;">{{ $mensagem }}</div>
            @endif

            <div class="w-100">
                <div class="list-group">
                    @foreach ($divisoes as $divisao)
                        <div class="list-group-item shadow-sm border-left-info">
                            <div class="row">
                                <div class="col">
                                    <p class="mb-1"><b>Nome da Divisao:</b> {{ucwords(mb_strtolower($divisao->nomeDivisao))}}</p>
                                    <p class="mb-1"><b>Chefe da Divisão:</b> {{ $divisao->administrador ? ucwords(mb_strtolower($divisao->administrador->user->name)) : "Nenhum chefe" }}</p>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                    <div class="text-right">
                                        <a href="{{route('divisao.servidor.create', $divisao->id)}}" title="ADICIONAR SERVIDOR">
                                            <span class="material-symbols-outlined text-success">person_add</span>
                                        </a>
                                        @if(auth()->user()->is_admin)
                                        <a href="#" class="delete"
                                           data-route="{{route('divisao.destroy', $divisao->id)}}">
                                            <span class="material-symbols-outlined text-danger">delete</span>
                                        </a>
                                        <a href="{{route('divisao.edit', $divisao->id)}}">
                                            <span class="material-symbols-outlined">edit_note</span>
                                        </a>
                                        @endif
                                        <a href="{{route('divisaoServidor.show', $divisao->id)}}" title="LISTAR SERVIDORES">
                                            <span class="material-symbols-outlined text-primary">groups</span>
                                        </a>
                                        <a href="{{route('boardDivisao.index', $divisao->id)}}">
                                            <span class="material-symbols-outlined">grid_view</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center my-4">
                    {{ $divisoes->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/delete/delete.js')}}"></script>
@endpush

