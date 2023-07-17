@extends('layouts.dashboard.app')
@push('css')
    <link rel="stylesheet" href="{{asset('css/forms/create.css')}}">
@endpush
@section('content')
 <div class="container-fluid">
        <div class="row">
            <div class="col col-12">
                <h3>Edição de Secretaria</h3>
                <hr>
                <br>
            </div>
            <div id="accordion" style="width: 80%; margin:0 auto;">
                <form id="formulario_registro" class="shadow" method="post" action="{{ route('secretarias.update', $secretaria->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header text-center bg-primary" id="headingOne" style="">
                            <h5 class="mb-0">
                                <input type="button" class="btn btn-link text-white font-weight-bold"
                                       value="DADOS DA SECRETARIA">
                            </h5>
                        </div>

                        <div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="text-dark input-group" name="nomeSecretaria" id="nomeSecretaria"
                                                   placeholder="NOME DA SECRETARIA:" value="{{$secretaria->nomeSecretaria}}">
                                        </div>
                                        @error('nomeSecretaria')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="text-dark input-group" name="siglaSecretaria" id="siglaSecretaria"
                                                   placeholder="SIGLA DA SECRETARIA:" value="{{$secretaria->siglaSecretaria}}">
                                        </div>
                                        @error('siglaSecretaria')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col col-12 text-right">
                                        <input type="submit" class="btn btn-primary font-weight-bold"
                                               value="Cadastrar">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
