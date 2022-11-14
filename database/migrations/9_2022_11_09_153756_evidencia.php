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
        Schema::create('evidencia', function (Blueprint $table){
            $table->id();
            
            $table->unsignedBigInteger('funcion_sustantiva_id');
            $table->foreign('funcion_sustantiva_id')->references('id')->on('funcion_sustantiva');
            
            $table->string('nombre_archivo', 500);
            $table->string('url', 500);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evidencia');
    }
};
