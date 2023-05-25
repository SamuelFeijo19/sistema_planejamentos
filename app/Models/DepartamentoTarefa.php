<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartamentoTarefa extends Model
{
    use HasFactory;

    protected $table = 'departamento_tarefa';

    protected $fillable = [
        'departamento_id',
        'criador_id',
        'nomeTarefa',
        'descricao',
        'situacao',
        'classificacao'
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id');
    }

}