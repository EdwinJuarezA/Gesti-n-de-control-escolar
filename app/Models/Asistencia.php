<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Alumno;
use App\Models\Ciclo;

class Asistencia extends Model
{
    use HasFactory;
    protected $fillable = ['alumno_id', 'ciclo_id','fecha'];
    protected $table = 'Asistencia'; // Se especifica el nombre correcto de la tabla

    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'alumno_id');
    }

    public function ciclo()
    {
        return $this->belongsTo(Ciclo::class, 'ciclo_id');
    }
}
