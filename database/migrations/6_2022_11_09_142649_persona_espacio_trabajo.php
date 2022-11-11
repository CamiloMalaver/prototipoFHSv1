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
        Schema::create('persona_espacio_trabajo', function(Blueprint $table){
            $table->id();
            
            $table->unsignedBigInteger('espacio_trabajo_id');
            $table->foreign('espacio_trabajo_id')->references('id')->on('espacio_trabajo');
            
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('persona_espacio_trabajo');
    }
};
