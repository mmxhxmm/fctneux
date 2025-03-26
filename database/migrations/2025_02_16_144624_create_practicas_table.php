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
        Schema::create('practicas', function (Blueprint $table) {
            $table->id();
            $table->string('cicloFormativo')->nullable();
            $table->string('cursoAcademico')->nullable();
            $table->date('periodoFrom')->nullable();
            $table->date('periodoTo')->nullable();
            $table->string('horarioFrom')->nullable();
            $table->string('horarioTo')->nullable();
            $table->string('convenioMarco')->nullable();
            $table->string('usoLogos')->nullable();
            $table->text('observaciones')->nullable();
            $table->integer('numPlazasAsignadas')->nullable();
            $table->integer('tecnicoGestion'); // FK user
            $table->integer('empresa_id'); // FK
            $table->timestamps();
        });

        Schema::create('tutores_empresa', function (Blueprint $table) {
            $table->id();
            $table->string('dni');
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('telefono')->nullable();
            $table->string('email')->nullable();
            $table->integer('id_practica'); // FK
            $table->timestamps();
        });

        Schema::create('tutores', function (Blueprint $table) {
            $table->id();
            $table->string('dni');
            $table->string('nombre');
            $table->string('apellido');
            $table->integer('telefono')->nullable();
            $table->string('email')->nullable();
            $table->integer('id_practica'); // FK
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practicas');
        Schema::dropIfExists('tutores_empresa');
        Schema::dropIfExists('tutores');
    }
};
