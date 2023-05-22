@extends('layouts.dashboard.app')

@section('content')

    <main class="container" id="ajuste">
        <div class="row">
            <div class="col col-12">
                <h3>Edição de Departamento</h3>
                <hr>
            </div>
            <div class="col col-12 m-auto">
                <form id="formulario_registro" method="post" action="{{ route('divisao.update', $divisao->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="departamento_id" value="{{ $divisao->departamento_id ?? ''}}">
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

                        <div id="collapseOne" class="collapse multi-collapse show" aria-labelledby="headingOne"  data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">

                                        <div class="form-group">
                                            <label for="titulo">Nome da Divisao:</label>
                                            <input type="text" class="form-control" name="nomeDivisao"
                                                   id="nomeDivisao" placeholder="Nome do Departamento:" value="{{ $divisao->nomeDivisao }}" required>
                                        </div>
                                        @error('nomeDivisao')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                        <div class="row">
                                            <div class="col col-12 text-right">
                                                <input type="submit" class="btn btn-outline-dark font-weight-bold"
                                                       value="Editar">
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
