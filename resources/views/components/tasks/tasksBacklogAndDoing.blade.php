<div class="card-item row" data-task-id="{{ $tarefa->id }}">
    @php
        $classificacaoText = '';
        $classificacaoBadge = '';
        if ($tarefa->classificacao == 0) {
            $classificacaoText = 'Alta';
            $classificacaoBadge = 'badge-alta';
        } elseif ($tarefa->classificacao == 1) {
            $classificacaoText = 'Média';
            $classificacaoBadge = 'badge-media';
        } else {
            $classificacaoText = 'Baixa';
            $classificacaoBadge = 'badge-baixa';
        }
    @endphp
    <span class="badge badge-xs {{ $classificacaoBadge }}">{{ $classificacaoText }}</span>
    <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning' : 'text-danger') }} text-dark"
       href="#" draggable="true"
       data-task-id="{{ $tarefa->id }}"
    >{{ $tarefa->nomeTarefa }}
    </a>
</div>
