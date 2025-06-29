<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('medico', function (Blueprint $table) {
            $table->id(); // PK autoincremental interna
            $table->string('nombre');
            $table->string('apellido');
            $table->string('id_medico')->unique(); // Cédula única
            $table->string('email')->unique();
            $table->unsignedBigInteger('user_id')->unique();
            $table->unsignedBigInteger('id_especialidad');

            // Llave foránea a users (relación con usuario)
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');

            // Llave foránea a especialidad
            $table->foreign('id_especialidad')
                  ->references('id_especialidad')
                  ->on('especialidad')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medico');
    }
};
