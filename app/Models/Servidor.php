<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
    use HasFactory;

    protected $table = 'servidores';

    protected $fillable = ['user_id', 'data_nascimento', 'cpf', 'matricula'];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
