@extends('layouts.dashboard.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col col-12">
                <h3>Edição de Secretaria</h3>
                <hr>
                <br>
            </div>
            <div id="accordion" style="width: 80%; margin:0 auto;">
                <form id="formulario_registro" method="post"
                      action="{{ route('secretarias.update', $secretaria->id) }} ">
                    {{--                        <input type="hidden" name="id" value="{{ $secretaria->id ?? ''}}">--}}
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header text-center bg-primary" id="headingOne" style="
                                 background: linear-gradient( rgba(28,132,198,1) 2%, rgba(5,66,105,1) 0%);
                            ">
                            <h5 class="mb-0">
                                <input type="button" class="btn btn-link text-white font-weight-bold"
                                       value="DADOS DA SECRETARIA">
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse multi-collapse show" aria-labelledby="headingOne"
                             data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="nomeSecretaria">Nome da Secretaria:</label>
                                            <input type="text" class="form-control" name="nomeSecretaria"
                                                   id="nomeSecretaria" placeholder="Nome da Secretaria:"
                                                   value="{{ $secretaria->nomeSecretaria }}" required>
                                        </div>
                                        @error('nomeSecretaria')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="siglaSecretaria">Sigla da Secretaria:</label>
                                            <input type="text" class="form-control" name="siglaSecretaria"
                                                   id="siglaSecretaria" placeholder="Sigla da Secretaria"
                                                   value="{{ $secretaria->siglaSecretaria }}" required>
                                        </div>
                                        @error('siglaSecretaria')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col col-12 text-right">
                                        <input type="submit" class="btn btn-outline-dark font-weight-bold"
                                               value="Atualizar">
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
