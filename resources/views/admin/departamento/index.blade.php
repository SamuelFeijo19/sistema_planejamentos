@extends('layouts.dashboard.app')

@section('content')
    <div class="container-fluid">
        <div style="width: 100%;">
            <div class="col col-12">
                <h3>Departamentos para {{ucwords(mb_strtolower($secretaria->nomeSecretaria))}}</h3>
                <hr>
            </div>

            {{--Componente do Botão de Adicionar--}}
            <x-adicionar.adicionar-button link-route="{{ route('departamento.create', $secretaria_id) }}"
                                          text-button="Novo Departamento"/>
            {{--Componente do Botão de Pesquisa--}}
            <x-search.search-button placeholder="Busque por Departamentos"
                                    form-action="{{ route('departamento.index', $secretaria_id) }}"/>

            @if(isset($mensagem))
                <div class="alert alert-warning" style="width: 300px;">{{ $mensagem }}</div>
            @endif

            <div class="w-100">
                <div class="list-group">
                    @foreach ($departamentos as $departamento)
                        <div class="list-group-item shadow-sm border-left-info">
                            <div class="row">
                                <div class="col">
                                    <p class="mb-1"><b>Nome do
                                            Departamento:</b> {{ucwords(mb_strtolower($departamento->nomeDepartamento))}}
                                    </p>
                                    <p class="mb-1"><b>Chefe do
                                            Departamento:</b> {{ $departamento->administrador ? ucwords(mb_strtolower($departamento->administrador->user->name)) : "Nenhum chefe" }}
                                    </p>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                    <div class="text-right">
                                        <a href="{{route('departamentoServidor.create', $departamento->id)}}"
                                           title="ADICIONAR SERVIDOR">
                                            <span class="material-symbols-outlined text-success">person_add</span>
                                        </a>

                                        <a href="{{route('departamentoServidor.show', $departamento->id)}}"
                                           title="LISTAR SERVIDORES">
                                            <span class="material-symbols-outlined text-primary">person</span>
                                        </a>

                                        <a href="#" class="delete"
                                           data-route="{{route('departamento.destroy', $departamento->id)}}">
                                            <span class="material-symbols-outlined text-danger">delete</span>
                                        </a>
                                        <a href="{{route('departamento.edit', $departamento->id)}}">
                                            <span class="material-symbols-outlined">edit_note</span>
                                        </a>
                                        <a href="{{route('divisao.show', $departamento->id)}}" title="LISTAR DIVISOES">
                                            <span class="material-symbols-outlined text-primary">groups</span>
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
                <div class="d-flex justify-content-center my-4">
                    {{ $departamentos->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('js/delete/delete.js')}}"></script>
@endpush

