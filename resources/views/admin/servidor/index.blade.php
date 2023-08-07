@extends('layouts.dashboard.app')

@section('content')

    <div class="container-fluid">
        <div style="width: 100%">
            <div class="col col-12">
                <h3>Servidores Cadastrados</h3>
                <hr>
            </div>

            {{--Componente do Botão de Adicionar--}}
            <x-adicionar.adicionar-button link-route="{{ route('servidores.create') }}" text-button="Novo Servidor"/>

            {{--Componente do Botão de Pesquisa--}}
            <x-search.search-button placeholder="Busque por Servidores" form-action="{{ route('servidores.index') }}"/>

            <div class="w-100">
                <div class="list-group">
                    @foreach ($servidores as $servidor)
                        <div class="list-group-item shadow-sm border-left-info">
                            <div class="row">
                                <div class="col">
                                    <p class="mb-1"><b>Nome do
                                            Servidor:</b> {{ucwords(mb_strtolower($servidor->user->name))}}</p>
                                    <small class="text-muted"><b>CPF:
                                        </b> {{$servidor->cpf}}
                                    </small>
                                    <br>
                                    <small class="text-muted"><b>Data de Nascimento:
                                        </b> {{date('d/m/Y', strtotime($servidor->data_nascimento))}}
                                    </small>
                                    <br>
                                    <small class="text-muted"><b>E-mail:
                                        </b> {{($servidor->user->email)}}
                                    </small>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                    <div class="text-right">
                                        <a href="#" class="delete"
                                           data-route="{{route('servidores.destroy', $servidor->id)}}" title="EXLUIR CADASTRO DO SERVIDOR">
                                            <span class="material-symbols-outlined text-danger">delete</span>
                                        </a>
                                        <a href="{{route('servidores.edit', $servidor->id)}}" title="EDITAR CADASTRO DO SERVIDOR">
                                            <span class="material-symbols-outlined">edit_note</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center my-4">
                    {{ $servidores->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection

@push('js')
    <script src="{{asset('js/delete/delete.js')}}"></script>
@endpush
