<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('motivo');
            $table->text('observations');
            $table->string('plandetrabajo');
            $table->foreignId('beneficiario_id')->nullable()->constrained('beneficiarios')->cascadeOnDelete();
            $table->foreignId('profesionale_id')->nullable()->constrained('profesionales')->cascadeOnDelete();
            $table->foreignId('estado_proyecto_id')->constrained('estado_proyectos')->cascadeOnDelete();
            $table->foreignId('producto_id')->constrained('productos')->cascadeOnDelete();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};
