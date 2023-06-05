@extends('layouts.dashboard.app')

@section('content')
    <style>
        h3{
            color: #2d91cb;
            font-weight: bold;
        }

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

    <main class="container" id="ajuste">
        <div class="row">
            <div class="col col-12">
                <h3>Cadastro de Divisão</h3>
                <hr>
            </div>
            <div class="col col-12 m-auto">
                <form id="formulario_registro" method="post" action="{{ route('divisao.store') }}">
                    @csrf
                    <br>
                    <div class="card">
                        <div class="card-header text-center bg-primary" id="headingOne" style="">
                            <h5 class="mb-0">
                                <input type="button" class="btn btn-link text-white font-weight-bold"
                                       value="DADOS DA DIVISÃO">
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse multi-collapse show" aria-labelledby="headingOne"
                             data-parent="#accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <input type="hidden" name="departamento_id" value="{{$departamento_id}}">

                                        <div class="form-group">
                                            <input type="text" class="text-dark input-group" name="nomeDivisao" id="nomeDivisao"
                                                   placeholder="NOME DA DIVISÃO:" value="">
                                        </div>
                                        @error('nomeDivisao')
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
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
