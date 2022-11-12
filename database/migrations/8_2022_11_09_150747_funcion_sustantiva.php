<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funcion_sustantiva', function (Blueprint $table) {
            $table->id();
            $table->string('consecutivo', 30);

            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->foreign('usuario_id')->references('id')->on('users');

            $table->date('fecha');
            $table->time('hora_inicio');
            $table->time('hora_final');
            $table->string('involucrados', 100)->nullable();
            $table->string('descripcion_actividad', 1000);
            $table->string('observaciones', 500);
            $table->string('observaciones_auditor', 500)->nullable();
            
            $table->unsignedBigInteger('estado_id')->nullable();
            $table->foreign('estado_id')->references('id')->on('estado');

            $table->unsignedBigInteger('tipo_funcion_id')->nullable();
            $table->foreign('tipo_funcion_id')->references('id')->on('tipo_funcion');

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
        Schema::dropIfExists('funcion_sustantiva');
    }
};
