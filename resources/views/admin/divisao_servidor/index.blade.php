@extends('layouts.dashboard.app')

@section('content')

    <div class="container-fluid">
        <div style="width: 100%">
            <div class="col col-12">
                <h3>Servidores Cadastrados na {{ucwords(mb_strtolower($divisao->nomeDivisao))}}</h3>
                {{-- <h4 class="alert alert-warning">Preencha corretamente todos os dados referentes ao evento que será cadastrado</h4> --}}
                <hr>
            </div>

            {{--Componente do Botão de Adicionar--}}
            <x-adicionar.adicionar-button link-route="{{route('divisaoServidor.create', $divisao_id)}}"
                                          text-button="Novo Servidor"/>

            {{--Componente do Botão de Pesquisa--}}
            <x-search.search-button placeholder="Busque por Servidores ..." form-action="#"/>

            <div class="w-100">
                <div class="list-group">
                    @foreach ($lotacoesDivisao as $lotacao)
                        <div class="list-group-item shadow-sm border-left-info">
                            <div class="row">
                                <div class="col">
                                    <p class="mb-1"><b>Nome do
                                            Servidor:</b> {{ucwords(mb_strtolower($lotacao->servidor->user->name))}}</p>
                                    <small class="text-muted"><b>CPF:
                                        </b> {{$lotacao->servidor->cpf}}
                                    </small>
                                    <br>
                                    <small class="text-muted"><b>Data de Nascimento:
                                        </b> {{date('d/m/Y', strtotime($lotacao->servidor->data_nascimento))}}
                                    </small>
                                    <br>
                                    <small class="text-muted"><b>E-mail:
                                        </b> {{($lotacao->servidor->user->email)}}
                                    </small>
                                </div>
                                @if(auth()->user()->is_admin)
                                    <div class="col d-flex justify-content-center align-items-center">
                                        <div class="text-right">
                                            <a href="#" class="delete"
                                               data-route="{{route('divisaoServidor.destroy', $lotacao->id)}}" title="EXCLUIR LOTAÇÃO DO SERVIDOR">
                                                <span class="material-symbols-outlined text-danger">delete</span>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <br>
                    @endforeach
                </div>
                {{--            <div class="d-flex justify-content-center my-4">--}}
                {{--                {{ $participantes->links('vendor.pagination.bootstrap-4') }}--}}
                {{--            </div>--}}
            </div>
        </div>
    </div>
    <br>
@endsection

@push('js')
    <script src="{{asset('js/delete/delete.js')}}"></script>
    <script src="{{asset('js/dataTables.min.js')}}"></script>
@endpush
