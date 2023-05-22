@extends('layouts.dashboard.app')
    @push('css')
        <link href="{{asset('css/select2.css')}}" rel="stylesheet" />
    @endpush
@section('content')
    <main class="container" id="ajuste">
        <div class="row">
            <div class="col col-12">
                <h3>Adicionar Servidor</h3>
                <hr>
            </div>
            <div id="accordion" style="width: 80%; margin:0 auto;">
                <form id="formulario_registro" method="post" action="{{ route('departamentoServidor.store') }}">
                    {{-- <input type="hidden" name="'id" value="{{ $matricula->id ?? ''}}"> --}}
                    @csrf
                    <div class="card">
                        <div class="card-header text-center bg-primary" id="headingOne">
                            <h5 class="mb-0">
                                <input type="" class="btn btn-link text-white font-weight-bold" value="LOTAÇÃO">
                            </h5>
                        </div>

                        <div id="collapseOne" class="collapse multi-collapse show" aria-labelledby="headingOne" data-parent="#accordion" >
                            <div class="card-body">
                                <input type="hidden" name="departamento_id" value="{{$departamento->id}}">

                                <div class="row">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Servidores</label>
                                            </div>
                                            <select name="servidor_id" for="servidor_id" class="js-example-basic-single custom-select" id="inputGroupSelect01" required>
                                                <option value="">Selecione o Servidor</option>
                                                @foreach ($servidores as $servidor)
                                                    <option value="{{ $servidor->id }}">{{ mb_strtoupper($servidor->user->name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col col-12 text-right">
                                        <input type="submit" class="btn btn-outline-dark font-weight-bold" value="Adicionar Servidor">
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
    <script src="{{asset('js/select2.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush
