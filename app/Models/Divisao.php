<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisao extends Model
{
    use HasFactory;

    protected $table = 'divisoes';

    protected $fillable = [
        'departamento_id',
        'nomeDivisao'
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id');
    }

    public function divisaoTarefas()
    {
        return $this->hasMany(DivisaoTarefa::class, 'divisao_id', 'id');

    }

}
