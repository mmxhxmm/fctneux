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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('cif');
            $table->string('nombre')->nullable();
            $table->string('colaboracion')->nullable();
            $table->string('gestiones')->nullable();
            $table->string('modalidad')->nullable();
            $table->string('oferta_laboral')->nullable();
            $table->string('entidad')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('codigoPostal')->nullable();
            $table->string('municipio')->nullable();
            $table->string('poblacion')->nullable();
            $table->string('familiaPersonal')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });

        Schema::create('responsables_convenio', function (Blueprint $table) {
            $table->id();
            $table->string('dni')->nullable();
            $table->string('nombre')->nullable();
            $table->string('apellido')->nullable();
            $table->integer('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('empresa_cif'); // FK
            // $table->foreign('empresa_cif')->references('cif')->on('empresas')->onDelete('cascade'); // Optional: delete child records when empresa is deleted
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
        Schema::dropIfExists('responsables_convenio');
    }
};
