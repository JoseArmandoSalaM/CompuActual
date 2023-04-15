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
        Schema::create('hallazgos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->enum('tipo', ['Software', 'Hardware','Ambos']);
            $table->text('descripcion');

            $table->unsignedBigInteger('proyecto_id'); 
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade');
            
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
        Schema::dropIfExists('hallazgos');
    }
};
