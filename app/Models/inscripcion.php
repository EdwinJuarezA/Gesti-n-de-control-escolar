<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Grupo_Materia;
use App\Models\Grupo_Materia;
use App\Models\Alumno;
use App\Models\Materia;
use App\Models\Grupo;

class Inscripcion extends Model
{
    use HasFactory;
    protected $table = 'inscripcion';
    //    protected $fillable = ['alumno_id', 'asignar_id'];

    //protected $fillable = 'calificaciones';//['grupo_id','alumno_id', 'materia_id'];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }
    public function materia()
    {
        return $this->belongsTo(Alumno::class, 'materia_id');
    }
    public function grupo()
    {
        return $this->belongsTo(Alumno::class, 'grupo_id');
    }

    public function grupo_materia()
    {
        return $this->belongsTo(Grupo_Materia::class, 'asignar_id');
    }
}
