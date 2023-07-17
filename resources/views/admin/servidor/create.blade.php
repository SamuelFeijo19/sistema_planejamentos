@extends('layouts.dashboard.app')
@push('css')
    <link rel="stylesheet" href="{{asset('css/forms/create.css')}}">
@endpush
@section('content')
    <main class="container-fluid">
        <div class="row">
            <div class="col col-12">
                <h3>Cadastro de Servidor</h3>
                <hr>
            </div>
            <div class="shadow-lg" style="width: 80%; margin:0 auto; border-radius: 7px;">
                <form id="formulario_registro" method="post" action="{{ route('servidores.store') }}">
                    @csrf
                    <div>
                        <div class="card-header text-center bg-primary" id="headingOne" style="">
                            <h5 class="mb-0">
                                <input type="button" class="btn btn-link text-white font-weight-bold"
                                       value="DADOS DO SERVIDOR">
                            </h5>
                        </div>

                        <div style="padding: 20px;">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        {{--                                            <label for="name">Nome Completo:</label>--}}
                                        <input type="text" class="text-dark input-group" name="name" id="name"
                                               placeholder="NOME COMPLETO:" value="">
                                    </div>
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        {{--                                            <label for="dataNascimento">Data de Nascimento:</label>--}}
                                        <input type="date" class="text-dark input-group" name="dataNascimento"
                                               id="dataNascimento" placeholder="" value="">
                                    </div>
                                    @error('dataNascimento')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        {{--                                            <label for="cpf">CPF: </label>--}}
                                        <input type="text" class="text-dark input-group" name="cpf" id="cpf"
                                               placeholder="CPF:" value="">
                                    </div>
                                    @error('cpf')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        {{--                                            <label for="matricula">MATRÍCULA: </label>--}}
                                        <input type="text" class="text-dark input-group" name="matricula" id="matricula"
                                               placeholder="MATRÍCULA:" value="">
                                    </div>
                                    @error('matricula')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        {{--                                            <label for="email">E-mail: </label>--}}
                                        <input type="email" class="text-dark input-group" name="email" id="email"
                                               placeholder="E-MAIL:" value="">
                                    </div>
                                    @error('email')
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
                </form>
            </div>
        </div>
    </main>
    <br>
@endsection

@push('js')
    <script src="{{asset('js/jquery.mask.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#cpf').mask('000.000.000-00', {reverse: true});
        });
    </script>
@endpush
