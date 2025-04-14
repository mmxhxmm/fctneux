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
            $table->string('nombre');
            $table->string('colaboracion')->nullable();
            $table->string('gestiones')->nullable();
            $table->string('modalidad')->nullable();
            $table->string('ofertaLaboral')->nullable();
            $table->string('entidad')->nullable();
            $table->string('comunidad')->nullable();
            $table->string('provincia')->nullable();
            $table->string('municipio')->nullable();
            $table->string('direccion')->nullable();
            $table->integer('codigoPostal')->nullable();
            $table->string('familiaPersonal')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });

        Schema::create('responsables_convenio', function (Blueprint $table) {
            $table->id();
            $table->string('dni');
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('telefono')->nullable();
            $table->string('email')->nullable();
            $table->integer('empresa_id'); // FK
            // $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade'); // Optional: delete child records when empresa is deleted
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
