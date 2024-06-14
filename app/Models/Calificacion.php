<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    use HasFactory;
    protected $table = 'calificaciones';
    protected $fillable = [
        'alumno_id',
        'asignar_id',
        'parcial1',
        'parcial2',
        'parcial3',
        'final',
    ];

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    public function grupoMateria()
    {
        return $this->belongsTo(Grupo_Materia::class, 'asignar_id');
    }

    public function materia()
    {
        return $this->hasOneThrough(Materia::class, Grupo_Materia::class, 'id', 'id', 'asignar_id', 'materia_id');
    }
}
