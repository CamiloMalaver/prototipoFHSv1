<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    use HasFactory;
    protected $table  = 'evidencia';
    protected $fillable = [
        'nombre_archivo',
        'url'
    ];
    public $timestamps = false;
    public function funcionsustantiva()
    {
        return $this->hasMany(FuncionSustantiva::class, 'usuario_id', 'id');
    }

}
