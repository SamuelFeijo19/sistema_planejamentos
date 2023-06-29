@extends('layouts.dashboard.app')

@section('content')
    <div class="container-fluid">
        <div style="width: 100%;">
            <div class="col col-12">
                <h3>Departamentos cadastrados</h3>
                <hr>
            </div>

            @if(auth()->user()->is_admin)
            {{--Componente do Botão de Adicionar--}}
            <x-adicionar.adicionar-button link-route="{{route('departamento.create', $secretaria_id=0)}}" text-button="Novo Departamento" />
            @endif

           {{--Componente do Botão de Pesquisa--}}
            <x-search.search-button placeholder="Busque por Departamentos" form-action="{{ route('departamento.index') }}" />

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
                                    <p class="mb-1"><b>Secretaria:</b> {{ucwords(mb_strtolower($departamento->secretaria->nomeSecretaria))}}</p>
                                    <p class="mb-1"><b>Chefe do Departamento:</b> {{ $departamento->administrador ? ucwords(mb_strtolower($departamento->administrador->user->name)) : "Nenhum chefe" }}</p>
                                </div>
                                <br>
                                <div class="col d-flex justify-content-center align-items-center">
                                    <div class="text-right">
                                        <a href="{{route('departamentos.servidor.create', $departamento->id)}}" title="ADICIONAR SERVIDOR">
                                            <span class="material-symbols-outlined text-success">person_add</span>
                                        </a>

                                        @if(auth()->user()->is_admin)
                                        <a href="#" class="delete"
                                           data-route="{{route('departamento.destroy', $departamento->id)}}">
                                            <span class="material-symbols-outlined text-danger">delete</span>
                                        </a>

                                        <a href="{{route('departamento.edit', $departamento->id)}}">
                                            <span class="material-symbols-outlined">edit_note</span>
                                        </a>
                                        @endif
                                        <a href="{{route('departamentoServidor.show', $departamento->id)}}" title="LISTAR SERVIDORES">
                                            <span class="material-symbols-outlined text-primary">groups</span>
                                        </a>
                                        <a href="{{route('divisao.show', $departamento->id)}}" title="LISTAR DIVISOES">
                                            <span class="material-symbols-outlined text-primary">moving_ministry</span>
                                        </a>
                                        <a href="{{route('boardDepartamento.index', $departamento->id)}}">
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

