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

<div class="card-item row{{ $tarefa->classificacao == 0 ? ' h-25' : '' }}" data-task-id="{{ $tarefa->id }}">
    <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning' : 'text-danger') }} text-dark"
       href="#"
       draggable="true"
       data-task-id="{{ $tarefa->id }}"
    >{{ $tarefa->nomeTarefa }}
    </a>
    <span class="badge badge-xs {{ $classificacaoBadge }}">{{ $classificacaoText }}</span>
</div>
