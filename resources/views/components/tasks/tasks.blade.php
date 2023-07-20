@php
    $classificacaoText = '';
    $classificacaoBadge = '';
    if ($tarefa->classificacao == 0) {
        $classificacaoText = 'Baixa';
        $classificacaoBadge = 'badge-baixa';
    } elseif ($tarefa->classificacao == 1) {
        $classificacaoText = 'Média';
        $classificacaoBadge = 'badge-media';
    } else {
        $classificacaoText = 'Alta';
        $classificacaoBadge = 'badge-alta';
    }
@endphp

@if($tarefa->situacao == 0 || $tarefa->situacao == 1)
    <div class="card-item row" data-task-id="{{ $tarefa->id }}">
        <span class="badge badge-xs {{ $classificacaoBadge }}">{{ $classificacaoText }}</span>
        <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }} text-dark task-link"
           href="#" draggable="true"
           data-task-id="{{ $tarefa->id }}">{{ $tarefa->nomeTarefa }}
        </a>
    </div>
@elseif($tarefa->situacao == 2)
    <div class="card-item row" data-task-id="{{ $tarefa->id }}">
        <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning' : 'text-danger') }} text-dark task-link"
           href="#"
           draggable="true"
           data-task-id="{{ $tarefa->id }}"
        >{{ $tarefa->nomeTarefa }}
        </a>
        <span class="badge badge-xs {{ $classificacaoBadge }}">{{ $classificacaoText }}</span>
    </div>
@endif
