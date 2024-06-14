<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

//agregamos el modelo de permisos de spatie
use Spatie\Permission\Models\Permission;

class SeederTablaPermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            //Operaciones sobre usuarios
            'ver-usuario',
            'crear-usuario',
            'editar-usuario',
            'borrar-usuario',

            //Operaciones sobre tabla roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            //Operaciones sobre alumnos
            'ver-alumno',
            'crear-alumno',
            'editar-alumno',
            'borrar-alumno',

            //Operaciones sobre Asignar materias al grupo
            'administrar-materias-asignadas',

            //Operaciones sobre administrar la asistencia
            'administrar-asistencia',

            //Operaciones sobre la toma de asistencia 
            'administrar-tomar-asistencia',

            //Operaciones sobre calificaciones
            'ver-calificacion',
            'editar-calificacion',

            //Operaciones sobre ciclos
            'ver-ciclo',
            'crear-ciclo',
            'editar-ciclo',
            'borrar-ciclo',

            //Operaciones sobre boletas
            'administrar-boletas',

            //Operaciones sobre grupos
            'ver-grupo',
            'crear-grupo',
            'editar-grupo',
            'borrar-grupo',

            //Operaciones para inscribir un alumno
            'administrar-inscripcion',

            //Operaciones asignar profesor a la materi 
            'asignar-profesor',

            //Operaciones sobre materias
            'ver-materia',
            'crear-materia',
            'editar-materia',
            'borrar-materia',

            //Operaciones sobre profesor
            'ver-profesor',
            'crear-profesor',
            'editar-profesor',
            'borrar-profesor',
        ];

        foreach($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}
