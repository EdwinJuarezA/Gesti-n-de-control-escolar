<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalificacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('alumno_id')->nullable()
            ->constrained('alumnos') ->onDelete('cascade');
            $table->foreignId('asignar_id')->nullable()
            ->constrained('grupo_materias') ->onDelete('cascade');
            $table->integer('parcial1')->nullable();
            $table->integer('parcial2')->nullable();
            $table->integer('parcial3')->nullable();
            $table->integer('final')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificaciones');
    }
}
