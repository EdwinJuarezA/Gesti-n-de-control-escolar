<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//Agregamos spatie
use Spatie\Permission\Traits\HasRoles;

class Materia extends Model
{
    use HasFactory;
    protected $fillable = ['clave_curso', 'nombre','semestre' ,'creditos'];
    
    public function grupoMaterias()
    {
        return $this->hasMany(Grupo_Materia::class, 'materia_id');
    }
}
