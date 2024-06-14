<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrupoMateriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupo_materias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('grupo_id')->nullable()
            ->constrained('grupos') ->onDelete('cascade');
            $table->foreignId('profesor_id')->nullable()
            ->constrained('profesors') ->onDelete('cascade');
            $table->foreignId('materia_id')->nullable()
            ->constrained('materias') ->onDelete('cascade');
            $table->integer('estatus')->default(1)->nullable();
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
        Schema::dropIfExists('grupo_materias');
    }
}
