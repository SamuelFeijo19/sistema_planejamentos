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
        'nomeDepartamento'
    ];

    public function secretaria()
    {
        return $this->belongsTo(Secretaria::class, 'secretaria_id', 'id');
    }

}
