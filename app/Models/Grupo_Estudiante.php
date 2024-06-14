<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grupo;
use App\Models\Alumno;
use App\Models\materia;

class Grupo_Estudiante extends Model
{
    use HasFactory;
    protected $fillable = ['grupo_id','alumno_id', 'materia_id'];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }
    
    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }
}