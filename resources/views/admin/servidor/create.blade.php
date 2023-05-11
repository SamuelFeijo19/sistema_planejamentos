@extends('layouts.dashboard.app')

@section('content')

    <main class="container-fluid" id="ajuste">
{{--        @dd($errors)--}}
        <div class="row">
            <div class="col col-12">
                <h3>Cadastro de Participante</h3>
                <hr>
            </div>
            <div id="accordion" style="width: 80%; margin:0 auto;">
                <form id="formulario_registro" method="post" action="{{ route('servidores.store') }}">
                    @csrf
                    <div class="card">
                        <div class="card-header text-center bg-dark" id="headingOne">
                            <h5 class="mb-0">
                                <input type="button" class="btn btn-link text-white font-weight-bold"
                                       value="DADOS DO SERVIDOR">
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse multi-collapse show" aria-labelledby="headingOne"
                             data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="name">Nome Completo:</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                   placeholder="NOME COMPLETO:" value="">
                                        </div>
                                        @error('nome')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="dataNascimento">Data de Nascimento:</label>
                                            <input type="date" class="form-control" name="dataNascimento"
                                                   id="dataNascimento" placeholder="Data de Nascimento:" value="">
                                        </div>
                                        @error('dataNascimento')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="cpf">CPF: </label>
                                            <input type="text" class="form-control" name="cpf" id="cpf"
                                                   placeholder="" value="">
                                        </div>
                                        @error('cpf')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="matricula">MATRÍCULA: </label>
                                            <input type="text" class="form-control" name="matricula" id="matricula"
                                                   placeholder="" value="">
                                        </div>
                                        @error('matricula')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email">E-mail: </label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                   placeholder="E-mail:" value="">
                                        </div>
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col col-12 text-right">
                                        <input type="submit" class="btn btn-outline-dark font-weight-bold"
                                               value="Cadastrar">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@push('js')
    <script src="{{asset('js/jquery.mask.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#cpf').mask('000.000.000-00', {reverse: true});
        });
    </script>
@endpush
