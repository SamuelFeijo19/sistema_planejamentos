@extends('layouts.dashboard.app')

@section('content')

    <main class="container" id="ajuste">
        <div class="row">
            <div class="col col-12">
                <h3>Edição do Cadastro de Servidores</h3>
                <hr>
            </div>
            <div id="accordion" class="m-auto w-100">
                <form method="post" action="{{ route('servidores.update', $servidor->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="card">
                        <div class="card-header text-center bg-primary" id="headingOne" style="
                             background: linear-gradient( rgba(28,132,198,1) 2%, rgba(5,66,105,1) 0%);
                         ">
                            <h5 class="mb-0">
                                <input type="button" class="btn btn-link text-white font-weight-bold"
                                       value="DADOS DO PARTICIPANTES">
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse multi-collapse show" aria-labelledby="headingOne"
                             data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="nome">NOME COMPLETO:</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                   placeholder="NOME COMPLETO:" value="{{ $servidor->user->name }}">
                                        </div>
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
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
                                                   placeholder="XXX.XXX.XXX-XX" value="{{ $servidor->cpf }}">
                                        </div>
                                        @error('cpf')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="matricula">Matrícula: </label>
                                            <input type="text" class="form-control" name="matricula" id="matricula"
                                                   placeholder="XXX.XXX.XXX-XX" value="{{ $servidor->matricula }}">
                                        </div>
                                        @error('matricula')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="email">E-MAIL: </label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                   placeholder="E-MAIL:" value="{{ $servidor->user->email }}">
                                        </div>
                                        @error('email')
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
