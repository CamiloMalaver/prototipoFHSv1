<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonaEspacioTrabajo extends Model
{
    use HasFactory;
    protected $table = "persona_espacio_trabajo";
    public $timestamps = false;
}
