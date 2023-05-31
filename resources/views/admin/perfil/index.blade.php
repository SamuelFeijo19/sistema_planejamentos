@extends('layouts.dashboard.app')
@push('css')
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
    <link rel="stylesheet" href="{{asset('css/dataTables.min.css')}}">
@endpush
@section('content')
    <main class="container-fluid">
        <div class="row">
            <div class="col col-12">
                <hr>
                <h3>Meus Dados</h3>
                <hr>
            </div>
            <div id="accordion" style="width: 80%; margin:0 auto;">
                <form method="post" action="{{ route('perfil.update', auth()->user()->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-header text-center bg-primary" id="headingOne" style="
                           background: linear-gradient( rgba(28,132,198,1) 2%, rgba(5,66,105,1) 0%);
                        ">
                            <h5 class="mb-0">
                                <input type="button" class="btn btn-link text-white font-weight-bold"
                                       value="DADOS DO PERFIL">
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse multi-collapse show" aria-labelledby="headingOne"
                             data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="nome">NOME COMPLETO:</label>
                                            <input type="text" class="form-control" name="nome" id="nome"
                                                   placeholder="NOME COMPLETO:" value="{{ $servidor->user->name }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="dataNascimento">Data de Nascimento:</label>
                                            <input type="text" class="form-control" name="dataNascimento"
                                                   id="dataNascimento" placeholder="Data de Nascimento:"
                                                   value="{{date('d/m/Y', strtotime($servidor->data_nascimento))}} ">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="cpf">CPF: </label>
                                            <input type="text" class="form-control" name="cpf" id="cpf"
                                                   placeholder="XXX.XXX.XXX-XX" value="{{ $servidor->cpf }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="matricula">Matrícula: </label>
                                            <input type="text" class="form-control" name="matricula" id="matricula"
                                                   placeholder="XXX.XXX.XXX-XX" value="{{ $servidor->matricula }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email">E-MAIL: </label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                   placeholder="E-MAIL:" value="{{ $servidor->user->email }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="password">Senha:</label>
                                            <input type="text" class="form-control" name="password" id="password"
                                                   placeholder="SENHA" value="">
                                        </div>
                                        @error('password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col col-12 text-right">
                                        <input type="submit" class="btn btn-outline-dark font-weight-bold"
                                               value="Editar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
            </div>
        </div>
    </main>

@endsection
@push('js')
    <script src="{{asset('js/jquery.mask.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#cpf').mask('000.000.000-00', {reverse: true});
            $('#dataNascimento').mask('00/00/0000');
        });
    </script>
@endpush
