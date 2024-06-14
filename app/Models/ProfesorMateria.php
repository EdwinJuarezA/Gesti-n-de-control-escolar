<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profesor;
use App\Models\Materia;
use App\Models\Grupo;
use App\Models\Grupo_Materia;

class ProfesorMateria extends Model
{
    use HasFactory;
    protected $fillable = 'profesormateria';

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

    public function grupo_materia()
    {
        return $this->belongsTo(Grupo_Materia::class, 'asignar_id');
    }
}
