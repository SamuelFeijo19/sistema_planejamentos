@extends('layouts.dashboard.app')

@section('content')
    <div class="container-fluid">
        <div style="width: 100%">
            <div class="col col-12">
                <h3>Servidores Cadastrados</h3>
                {{-- <h4 class="alert alert-warning">Preencha corretamente todos os dados referentes ao evento que será cadastrado</h4> --}}
                <hr>
            </div>

            {{-- Componente do Botão de Adicionar--}}
            <x-adicionar.adicionar-button link-route="{{route('departamentoServidor.create', $departamento_id)}}"
                                          text-button="Novo Servidor"/>

            {{-- Componente do Botão de Pesquisa--}}
            <x-search.search-button placeholder="  Digite o nome do Servidor ..." form-action="#"/>

            @if(isset($mensagem))
                <div class="alert alert-warning" style="width: 300px;">{{ $mensagem }}</div>
            @endif

            <div class="w-100">
                <div class="list-group">
                    @foreach ($lotacoesDepartamento as $lotacao)
                        <div class="list-group-item shadow-sm border-left-info">
                            <div class="row">
                                <div class="col">
                                    <p class="mb-1"><b>Nome do
                                            Servidor:</b> {{ ucwords(mb_strtolower($lotacao->servidor->user->name)) }}
                                    </p>
                                    <small class="text-muted"><b>CPF:</b> {{ $lotacao->servidor->cpf }}</small>
                                    <br>
                                    <small class="text-muted"><b>Data de
                                            Nascimento:</b> {{ date('d/m/Y', strtotime($lotacao->servidor->data_nascimento)) }}
                                    </small>
                                    <br>
                                    <small class="text-muted"><b>E-mail:</b> {{ $lotacao->servidor->user->email }}
                                    </small>
                                    <br>
                                    <small
                                        class="text-muted"><b>Lotação:</b> {{ ucwords(mb_strtolower($lotacao->departamento->nomeDepartamento)) }}
                                    </small>
                                </div>
                                @if(auth()->user()->is_admin)
                                    <div class="col d-flex justify-content-center align-items-center">
                                        <div class="text-right">
                                            <a href="#" class="delete"
                                               data-route="{{ route('departamentoServidor.destroy', $lotacao->id) }}">
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
                <div class="d-flex justify-content-center my-4">
                    {{ $lotacoesDepartamento->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection

@push('js')
    <script src="{{asset('js/delete/delete.js')}}"></script>
    <script src="{{asset('js/dataTables.min.js')}}"></script>
@endpush
