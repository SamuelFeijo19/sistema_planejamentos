<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lotacao extends Model
{
    use HasFactory;
    protected $table = 'departamento_servidor';

    protected $fillable = ['servidor_id', 'departamento_id'];


    public function servidor(){
        return $this->belongsTo(Servidor::class, 'servidor_id', 'id');
    }

    public function departamento(){
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id');
    }
}
