<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialTable extends Migration
{
    public function up()
    {
        Schema::create('historial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cita_id')->unique(); // Una cita tiene un historial (1:1)
            $table->text('sintomas')->nullable();
            $table->text('diagnostico')->nullable();
            $table->text('tratamientos')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();

            // Llave foránea a la tabla citas
            $table->foreign('cita_id')->references('id')->on('citas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('historial');
    }
}
