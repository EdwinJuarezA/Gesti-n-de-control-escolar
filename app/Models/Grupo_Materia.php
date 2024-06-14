<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profesor;
use App\Models\Materia;
use App\Models\Grupo;

class Grupo_Materia extends Model
{
    use HasFactory;
    protected $table = 'grupo_materias';
    protected $fillable = ['grupo_id','profesor_id','materia_id','estatus'];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    public function profesor()
    {
        return $this->belongsTo(Profesor::class, 'profesor_id');
    }

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    public function alumnos()
    {
        return $this->hasManyThrough(Alumno::class, Calificacion::class, 'asignar_id', 'id', 'id', 'alumno_id');
    }
    

}
