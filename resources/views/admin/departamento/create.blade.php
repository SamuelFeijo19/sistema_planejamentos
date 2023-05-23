@extends('layouts.dashboard.app')

@section('content')
    <main class="container" id="ajuste">
        <div class="row">
            <div class="col col-12">
                <h3>Cadastro de Departamento</h3>
                <hr>
            </div>
            <div class="col col-12 m-auto">
                <form id="formulario_registro" method="post" action="{{ route('departamento.store') }}">
                    @csrf
                    <br>
                    <div class="card">
                        <div class="card-header text-center bg-primary" id="headingOne" style="
                             background: linear-gradient( rgba(28,132,198,1) 2%, rgba(5,66,105,1) 0%);
                        ">
                            <h5 class="mb-0">
                                <input type="button" class="btn btn-link text-white font-weight-bold"
                                       value="DADOS DO DEPARTAMENTO">
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse multi-collapse show" aria-labelledby="headingOne"
                             data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <input type="hidden" name="secretaria_id" value="{{$secretaria_id}}">

                                        <div class="form-group">
                                            <label for="nomeDepartamento">Nome do Departamento:</label>
                                            <input type="text" class="form-control" name="nomeDepartamento"
                                                   id="nomeDepartamento" placeholder="Nome do Departamento:" required>
                                        </div>
                                        @error('nomeDepartamento')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="row">
                                            <div class="col col-12 text-right">
                                                <input type="submit" class="btn btn-outline-dark font-weight-bold"
                                                       value="Cadastrar">
                                            </div>
                                        </div>
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
