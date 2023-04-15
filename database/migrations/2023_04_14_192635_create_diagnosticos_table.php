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
        Schema::create('diagnosticos', function (Blueprint $table) {
            $table->id();
             
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('foto_pieza');
            $table->string('tiempo_instalacion');
            $table->string('ponderacion');
            $table->decimal('costo',8,2);


            $table->unsignedBigInteger('hallazgo_id'); 
            $table->foreign('hallazgo_id')->references('id')->on('hallazgos')->onDelete('cascade');
            
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
        Schema::dropIfExists('diagnosticos');
    }
};
