@extends('layouts.dashboard.app')

@section('content')
<main class="container" id="ajuste">
    <div class="row">
        <div class="col col-12">
            <h3>Cadastro de Departamento</h3>
            <hr>
        </div>
        <div class="col col-12 m-auto">
            <form id="formulario_registro" method="post" action="{{ route('tarefas.store') }}">
                @csrf
                <br>
                <div class="card">
                    <div class="card-header text-center bg-primary" id="headingOne" style="
                             background: linear-gradient( rgba(28,132,198,1) 2%, rgba(5,66,105,1) 0%);
                        ">
                        <h5 class="mb-0">
                            <input type="button" class="btn btn-link text-white font-weight-bold"
                                   value="DADOS DA TAREFA">
                        </h5>
                    </div>

                    <div id="collapseOne" class="collapse multi-collapse show" aria-labelledby="headingOne"
                         data-parent="#accordion">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" name="departamento_id" value="{{$departamento_id}}">

                                    <div class="form-group">
                                        <label for="nomeTarefa">Nome da Tarefa:</label>
                                        <input type="text" class="form-control" name="nomeTarefa"
                                               id="nomeTarefa" placeholder="Nome da Tarefa:" required>
                                    </div>
                                    @error('nomeTarefa')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="descricao">Descricao da Tarefa:</label>
                                        <input type="text" class="form-control" name="descricao"
                                               id="descricao" placeholder="Descricao da Tarefa:" required>
                                    </div>
                                    @error('descricao')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="situacao">Descricao da Tarefa:</label>
                                        <select name="situacao" for="situacao" class="custom-select"
                                                id="inputGroupSelect02">
                                            <option value="0" selected>Backlog</option>
                                            <option value="1" >Doing</option>
                                            <option value="2">Code Review</option>
                                        </select>
                                    </div>
                                    @error('situacao')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="classificacao">Classificação da Tarefa:</label>
                                        <select name="classificacao" for="classificacao" class="custom-select"
                                                id="inputGroupSelect02">
                                            <option value="0" selected>Baixa Prioridade</option>
                                            <option value="1" >Média prioridade</option>
                                            <option value="2" >Alta Prioridade</option>
                                        </select>
                                    </div>
                                    @error('classificacao')
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
