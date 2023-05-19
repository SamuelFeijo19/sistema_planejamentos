<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisaoServidor extends Model
{
    use HasFactory;
    protected $table = 'divisao_servidor';

    protected $fillable = ['servidor_id', 'divisao_id'];


    public function servidor(){
        return $this->belongsTo(Servidor::class, 'servidor_id', 'id');
    }

    public function divisao(){
        return $this->belongsTo(Divisao::class, 'divisao_id', 'id');
    }
}
