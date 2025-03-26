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
        Schema::create('tareas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('asignado');
            $table->enum('estado', ['to_do', 'in_progress', 'revision', 'blocked', 'done'])->default('to_do');
            $table->text('descripcion')->nullable();
            $table->time('fecha_limite')->nullable();
            $table->string('empresa_cif'); // FK
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tareas');
    }
};
