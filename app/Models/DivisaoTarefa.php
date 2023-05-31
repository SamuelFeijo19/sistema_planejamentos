<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisaoTarefa extends Model
{
    use HasFactory;

    protected $table = 'divisao_tarefa';

    protected $fillable = [
        'divisao_id',
        'criador_id',
        'nomeTarefa',
        'descricao',
        'situacao',
        'classificacao',
        'numeroChamado'
    ];

    public function divisao()
    {
        return $this->belongsTo(Divisao::class, 'divisao_id', 'id');
    }

}
