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
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            
            $table->string('folio')->nullable();
            $table->decimal('costo_final', 8, 2)->nullable();
            $table->decimal('costo_aprox', 8, 2)->nullable();
            $table->decimal('dinero_acuenta', 8, 2)->nullable();
            $table->date('fecha_recibido')->nullable();
            $table->date('fecha_entregado')->nullable();

            $table->text('descripcion_problema')->nullable();
            
            $table->enum('tipo_servicio', ['Software', 'Hardware','Ambos']);

            $table->unsignedBigInteger('trabajador_id'); 
            $table->foreign('trabajador_id')->references('id')->on('trabajadores')->onDelete('cascade');
            
            $table->unsignedBigInteger('cliente_id'); 
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');



            $table->unsignedBigInteger('etapa_id')->nullable();
            
            

            
            $table->foreign('etapa_id')
                    ->references('id')  
                    ->on('etapas')
                    ->onDelete('set null')
                    ->onUpdate('cascade');

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
        Schema::dropIfExists('proyectos');
    }
};
