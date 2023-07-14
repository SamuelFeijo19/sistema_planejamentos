@extends('layouts.dashboard.app')

@section('content')
    <style>
        .input-group{
            display: block;
            color: #e2e3e8;
            font-size: 16px;
            width: 100%;
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #6e707e;
            padding: 8px 0;
            appearance: none;
            outline: none;
        }
    </style>

    <div class="container-fluid">
    <div class="row">
        <div class="col col-12">
            <h3>Cadastro de Secretaria</h3>
            <hr>
            <br>
        </div>
        <div id="accordion" style="width: 80%; margin:0 auto;">
            <form id="formulario_registro" class="shadow" method="post" action="{{ route('secretarias.store') }}">
                <input type="hidden" name="'id" value="{{ $secretaria->id ?? '' }}">
                @csrf
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
                                               placeholder="NOME DA SECRETARIA:" value="">
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
                                               placeholder="SIGLA DA SECRETARIA:" value="">
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
