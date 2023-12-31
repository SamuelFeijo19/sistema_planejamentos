@extends('layouts.dashboard.app')
@push('css')
    <link rel="stylesheet" href="{{asset('css/forms/create.css')}}">
@endpush
@section('content')
    <main class="container" id="ajuste">
        <div class="row">
            <div class="col col-12">
                <h3>Cadastro de Tarefas</h3>
                <hr>
            </div>
            <div class="shadow-lg" style="width: 80%; margin:0 auto; border-radius: 7px;">
                <form id="formulario_registro" method="post" action="{{ route('tarefasDepartamento.store') }}">
                    @csrf
                    <div>
                        <div class="card-header text-center bg-primary" id="headingOne" style="">
                            <h5 class="mb-0">
                                <input type="button" class="btn btn-link text-white font-weight-bold"
                                       value="DADOS DA TAREFA">
                            </h5>
                        </div>

                        <div style="padding: 20px;">
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" name="departamento_id" value="{{$departamento_id}}">

                                    <div class="form-group">
                                        <input type="text" class="text-dark input-group" name="nomeTarefa"
                                               id="nomeTarefa" placeholder="Nome da Tarefa:" required>
                                    </div>
                                    @error('nomeTarefa')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="text-dark input-group" name="descricao" id="descricao"
                                               placeholder="DESCRIÇÃO:" value="">
                                    </div>
                                    @error('descricao')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="text-dark input-group" name="numeroChamado"
                                               id="numeroChamado"
                                               placeholder="Número do Chamado (Quando houver):" value="">
                                    </div>
                                    @error('numeroChamado')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="data_conclusao_prevista" class="text-dark mb-0">Data Prevista para
                                            Conclusão da Tarefa:</label>
                                        <input type="date" class="text-dark input-group" name="data_conclusao_prevista"
                                               id="data_conclusao_prevista">
                                    </div>
                                    @error('data_conclusao_prevista')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="situacao">Situação da Tarefa:</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="situacao" id="situacao"
                                                   value="0" checked>
                                            <label class="form-check-label" for="inlineRadio1">Backlog</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="situacao" id="situacao"
                                                   value="1">
                                            <label class="form-check-label" for="inlineRadio2">Doing</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="situacao" id="situacao"
                                                   value="2">
                                            <label class="form-check-label" for="inlineRadio3">Code Review</label>
                                        </div>
                                    </div>
                                    @error('situacao')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="classificacao">Classificação da Tarefa:</label>
                                        <br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="classificacao"
                                                   id="classificacao" value="0" checked>
                                            <label class="form-check-label" for="inlineRadio1">Baixa Prioridade</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="classificacao"
                                                   id="classificacao" value="1">
                                            <label class="form-check-label" for="inlineRadio2">Média Prioridade</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="classificacao"
                                                   id="classificacao" value="2">
                                            <label class="form-check-label" for="inlineRadio3">Alta Prioridade</label>
                                        </div>
                                    </div>
                                    @error('situacao')
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
@endsection
