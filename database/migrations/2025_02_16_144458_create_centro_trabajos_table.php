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
        Schema::create('centros_trabajo', function (Blueprint $table) {
            $table->id();
            $table->integer('codigoPostal')->nullable();
            $table->string('comunidad')->nullable();
            $table->string('provincia')->nullable();
            $table->string('municipio')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('empresa_id'); // FK
            $table->timestamps();
        });

        Schema::create('personas_contacto', function (Blueprint $table) {
            $table->id();
            $table->string('dni');
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('id_centrosTrabajo'); // FK
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('centros_trabajo');
        Schema::dropIfExists('personas_contacto');
    }
};
