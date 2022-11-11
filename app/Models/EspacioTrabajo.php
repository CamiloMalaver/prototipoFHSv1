<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EspacioTrabajo extends Model
{
    use HasFactory;
    protected $table = 'espacio_trabajo';
    public $timestamps = false;
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'persona_espacio_trabajo', 'id', 'usuario_id');
    }   
    
}
