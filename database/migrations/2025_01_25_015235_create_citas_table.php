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
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->string('estado');
            $table->date('fecha');
            $table->time('hora');
            $table->string('tipo_cita');
            $table->foreignId('id_paciente')->constrained('pacientes')->onDelete('cascade');
            $table->foreignId('id_medico')->constrained('medicos')->onDelete('cascade');
            $table->foreignId('id_historial')->nullable()->constrained('historiales')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
