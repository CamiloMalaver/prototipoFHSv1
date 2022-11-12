<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuncionSustantiva extends Model
{
    use HasFactory;
    protected $table = 'funcion_sustantiva';

    public function tipofuncion()
    {
        return $this->hasOne(TipoFuncion::class, 'id', 'tipo_funcion_id');
    }


}
