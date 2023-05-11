@extends('layouts.dashboard.app')
@push('css')
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
@endpush
@section('content')
    <div class="container-fluid">
        <div style="width: 100%;">
            <div class="col col-12">
                <h3>Secretarias Cadastradas</h3>
                {{-- <h4 class="alert alert-warning">Preencha corretamente todos os dados referentes ao evento que será cadastrado</h4> --}}
                <hr>
            </div>

        <div class="w-100">
            <div class="list-group">
                @foreach ($secretarias as $secretaria)
                    <div class="list-group-item shadow-sm">
                        <div class="row">
                            <div class="col">
                                <p class="mb-1"><b>Nome:</b> {{ucwords(mb_strtolower($secretaria->nomeSecretaria))}}</p>
                                <p class="mb-1"><b>Sigla
                                        </b> {{$secretaria->siglaSecretaria}}</p>
                            </div>
                            <div class="col d-flex justify-content-center align-items-center">
                                <div class="text-right">
                                    <a href="#" class="delete" data-route="{{route('secretarias.destroy', $secretaria->id)}}">
                                        <span class="material-symbols-outlined text-danger">delete</span>
                                    </a>
                                    <a href="{{route('secretarias.edit', $secretaria->id)}}">
                                        <span class="material-symbols-outlined">edit_note</span>
                                    </a>
                                    <a href="{{route('departamento.index', $secretaria->id)}}">
                                        <span class="material-symbols-outlined">groups</span>
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
    <br>
@endsection

@push('js')
    <script src="{{asset('js/delete/delete.js')}}"></script>
@endpush

