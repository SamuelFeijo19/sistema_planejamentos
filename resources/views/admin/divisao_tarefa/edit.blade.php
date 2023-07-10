@extends('layouts.dashboard.app')

@section('content')
<main class="container" id="ajuste">
    <div class="row">
        <div class="col col-12">
            <h3>Edição de Tarefas</h3>
            <hr>
        </div>
        <div class="col col-12 m-auto">
            <form id="formulario_registro" method="post" action="{{ route('tarefasDivisao.update', $tarefa->id)}}">
                @method('PUT')
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
                                    <div class="form-group">
                                        <label for="nomeTarefa">Nome da Tarefa:</label>
                                        <input type="text" class="form-control" name="nomeTarefa"
                                               id="nomeTarefa" placeholder="Nome da Tarefa:" value="{{ $tarefa->nomeTarefa }}" required>
                                    </div>
                                    @error('nomeTarefa')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="descricao">Descricao da Tarefa:</label>
                                        <input type="text" class="form-control" name="descricao"
                                               id="descricao" placeholder="Descricao da Tarefa:" value="{{ $tarefa->descricao }}" required>
                                    </div>
                                    @error('descricao')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="numeroChamado">Número do Chamado (Quando houver):</label>
                                        <input type="text" class="form-control" name="numeroChamado"
                                               id="numeroChamado" placeholder="Número do Chamado:" value="{{ $tarefa->numeroChamado }}">
                                    </div>
                                    @error('numeroChamado')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="data_conclusao_prevista" class="text-dark mb-0">Data Prevista para Conclusão da Tarefa:</label>
                                                <input type="date" class="text-dark input-group" name="data_conclusao_prevista" id="data_conclusao_prevista"
                                                       value="{{$tarefa->data_conclusao_prevista}}">
                                            </div>
                                            @error('data_conclusao_prevista')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="situacao">Descricao da Tarefa:</label>
                                        <select name="situacao" for="situacao" class="custom-select"
                                                id="inputGroupSelect02">
                                            <option value="0" {{$tarefa->situacao == 0 ? 'selected' : ''}}>Backlog</option>
                                            <option value="1" {{$tarefa->situacao == 1 ? 'selected' : ''}}>Doing</option>
                                            <option value="2" {{$tarefa->situacao == 2 ? 'selected' : ''}}>Code Review</option>
                                            <option value="3" {{$tarefa->situacao == 3 ? 'selected' : ''}}>Concluida</option>
                                        </select>
                                    </div>
                                    @error('situacao')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="form-group">
                                        <label for="classificacao">Classificação da Tarefa:</label>
                                        <select name="classificacao" for="classificacao" class="custom-select"
                                                id="inputGroupSelect02">
                                            <option value="0" {{$tarefa->classificacao == 0 ? 'selected' : ''}}>Baixa Prioridade</option>
                                            <option value="1" {{$tarefa->classificacao == 1 ? 'selected' : ''}}>Média prioridade</option>
                                            <option value="2" {{$tarefa->classificacao == 2 ? 'selected' : ''}}>Alta Prioridade</option>
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
