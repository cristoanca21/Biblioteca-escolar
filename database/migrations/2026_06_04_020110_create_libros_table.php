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
    Schema::create('libros', function (Blueprint $table) {
        $table->id();
        // Relación con categorías (Llave foránea)
        $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
        $table->string('titulo');
        $table->string('autor');
        $table->integer('año');
        $table->string('portada')->nullable(); // Aquí guardaremos la ruta de la imagen
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('libros');
    }
};
