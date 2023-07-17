@extends('layouts.dashboard.app')
@push('css')
    <link rel="stylesheet" href="{{asset('css/forms/create.css')}}">
@endpush
@section('content')
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
                                        <div class="form-group">
                                            <input type="text" class="text-dark input-group" name="nomeDivisao"
                                                   id="nomeDivisao"
                                                   placeholder="NOME DA DIVISÃO:" value="">
                                        </div>
                                        @error('nomeDivisao')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class=" mb-3">
                                            <div class="input-group-prepend">
                                                <label class="text-dark" for="inputGroupSelect">SECRETARIA QUE A DIVISÃO
                                                    PERCENTE</label>
                                            </div>
                                            <select name="secretaria_id" for="secretaria_id"
                                                    class="js-example-basic-single custom-select"
                                                    id="inputGroupSelect01"
                                                    required>
                                                <option value="">Selecione a Secretaria</option>
                                                @foreach ($secretarias as $secretaria)
                                                    <option
                                                        value="{{ $secretaria->id }}">{{ mb_strtoupper($secretaria->nomeSecretaria) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class=" mb-3">
                                            <div class="input-group-prepend">
                                                <label class="text-dark"
                                                       for="departamentoSelectDivisao">DEPARTAMENTO QUE A DIVISÃO
                                                    PERTENCE</label>
                                            </div>
                                            <select name="departamento_id" for="departamento_id"
                                                    class="js-example-basic-single custom-select departamentoSelect"
                                                    id="departamentoSelectDivisao" required>
                                                <option value="">Selecione o Departamento</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class=" mb-3">
                                            <div class="input-group-prepend">
                                                <label class="text-dark" for="inputGroupSelect01">CHEFE DO DEPARTAMENTO
                                                    (OPCIONAL)</label>
                                            </div>
                                            <select name="administrador_id" for="administrador_id"
                                                    class="js-example-basic-single custom-select"
                                                    id="inputGroupSelect01">
                                                <option value="">Selecione o Servidor</option>
                                                @foreach ($servidores as $servidor)
                                                    <option
                                                        value="{{ $servidor->id }}">{{ mb_strtoupper($servidor->user->name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
                </form>
            </div>
        </div>
    </main>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            // Inicializa o seletor do departamento
            $('.js-example-basic-single');

            // Quando a secretaria é alterada, carrega os departamentos correspondentes
            $('#inputGroupSelect01').change(function () {
                var secretariaId = $(this).val();
                if (secretariaId) {
                    $.ajax({
                        url: '{{ route('departamentos.porSecretaria', ':secretaria_id') }}'.replace(':secretaria_id', secretariaId),
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            $('#departamentoSelectDivisao').empty();
                            if (data.length > 0) {
                                $.each(data, function (key, value) {
                                    $('#departamentoSelectDivisao').append('<option value="' + value.id + '">' + value.nomeDepartamento + '</option>');
                                });
                            } else {
                                $('#departamentoSelectDivisao').append('<option value="">Nenhum departamento encontrado para esta secretaria</option>');
                            }
                        }
                    });
                } else {
                    $('#departamentoSelectDivisao').empty();
                }
            });
        });
    </script>
@endpush
