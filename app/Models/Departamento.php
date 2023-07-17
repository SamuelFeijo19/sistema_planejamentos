<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = 'departamentos';

    protected $fillable = [
        'secretaria_id',
        'nomeDepartamento',
        'administrador_id' // adicionando o campo para o ID do administrador
    ];

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class, 'secretaria_id', 'id');
    }

    public function departamentoTarefas()
    {
        return $this->hasMany(DepartamentoTarefa::class, 'departamento_id', 'id');

    }

    public function administrador()
    {
        return $this->belongsTo(Servidor::class, 'administrador_id', 'id');
    }

    public function servidores()
    {
        return $this->belongsToMany(Servidor::class, 'departamento_servidor', 'departamento_id', 'servidor_id');
    }


}
