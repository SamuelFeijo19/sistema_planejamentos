<div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="d-flex align-items-center">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Progresso de Tarefas
                        </div>
                        <span class="text-info material-symbols-outlined ml-2 mb-2">
                                    rotate_right
                                </span>
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                {{ number_format($porcentagemAndamento, 1) }}%
                            </div>
                        </div>
                        <div class="col">
                            <div class="progress progress-sm mr-2">
                                <div class="progress-bar bg-info" role="progressbar"
                                     style="width: {{ $porcentagemAndamento }}%"
                                     aria-valuenow="{{ $porcentagemAndamento }}"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
