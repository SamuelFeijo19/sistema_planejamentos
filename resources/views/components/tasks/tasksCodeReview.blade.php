@if($tarefa->classificacao == 0)
    <div class="card-item row h-25"
         data-task-id="{{ $tarefa->id }}">
        <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }} text-dark"
           href="#" draggable="true"
           data-task-id="{{ $tarefa->id }}"
        >{{ $tarefa->nomeTarefa }}
        </a>
        <span class="badge badge-xs badge-alta">Alta</span>
    </div>
@elseif($tarefa->classificacao == 1)
    <div class="card-item row"
         data-task-id="{{ $tarefa->id }}">
        <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }} text-dark"
           href="#" draggable="true"
           data-task-id="{{ $tarefa->id }}"
        >{{ $tarefa->nomeTarefa }}
        </a>
        <span class="badge badge-xs badge-media">Média</span>
    </div>
@else
    <div class="card-item row"
         data-task-id="{{ $tarefa->id }}">
        <a class="{{ $tarefa->classificacao == 0 ? 'text-success' : ($tarefa->classificacao == 1 ? 'text-warning'  : 'text-danger') }} text-dark"
           href="#" draggable="true"
           data-task-id="{{ $tarefa->id }}"
        >{{ $tarefa->nomeTarefa }}
        </a>
        <span class="badge badge-xs badge-baixa">Baixa</span>
    </div>
@endif
