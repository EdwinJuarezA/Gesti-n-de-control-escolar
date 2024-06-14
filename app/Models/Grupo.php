<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profesor;
use App\Models\Materia;
use App\Models\Grupo_Materia;
use App\Models\ciclo;

class Grupo extends Model
{
    use HasFactory;
    protected $fillable = ['nombre','ciclo_id'];

    /**
     * Obtener los datos de las llaves foraneas
     */

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class, 'ciclo_id');
    }

    public function grupoMaterias()
    {
        return $this->hasMany(Grupo_Materia::class, 'grupo_id');
    }

    public function alumnos()
    {
        return $this->hasMany(Alumno::class);
    }

}
