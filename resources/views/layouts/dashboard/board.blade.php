@extends('layouts.dashboard.app')

@section('content')
<h3 style="padding-left: 20px;">Divisão XXXXX</h3>

<div class="container-fluid mt-4 shadow-lg" style="
                background: #858796;
                padding-top: 20px;
                width: 90%;
                border-radius: 10px;
                "
>
    <h3 class="text-light">Nome Servidor</h3>
    <div class="row">
        <div class="col">
            <div class="card-columns">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Backlog
                    </div>
                    <div class="card-body shadow-sm">
                        <div class="card">
                            <div class="card-body">
                                Task 1
                                <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                            </div>

                        </div>
                        <div class="card">
                            <div class="card-body">
                                Task 2
                                <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                Task 3
                                <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-success text-white">
                        Doing
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                Task 4
                                <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        Code Review
                    </div>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-body">
                                Task 5
                                <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                Task 6
                                <span style="float: right;" class="material-symbols-outlined">
                                                arrow_drop_down
                                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
