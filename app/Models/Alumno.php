<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grupo;

use Spatie\Permission\Traits\HasRoles;

class Alumno extends Model
{
    use HasFactory;
    protected $fillable = ['matricula', 'nombre','apellido','sexo','semestre', 'especialidad', 'grupo_id'];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    public function grupoMaterias()
    {
        return $this->belongsToMany(Grupo_Materia::class, 'calificaciones', 'alumno_id', 'asignar_id');
    }

}
