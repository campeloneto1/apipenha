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
        Schema::disableForeignKeyConstraints();
        Schema::create('perfis', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100)->unique();
            $table->boolean('administrador')->nullable();
            $table->boolean('gestor')->nullable();
            $table->boolean('relatorios')->nullable();

            $table->boolean('agressores')->nullable();
            $table->boolean('agressores_cad')->nullable();
            $table->boolean('agressores_edt')->nullable();
            $table->boolean('agressores_del')->nullable();

            $table->boolean('denuncias')->nullable();
            $table->boolean('denuncias_cad')->nullable();
            $table->boolean('denuncias_edt')->nullable();
            $table->boolean('denuncias_del')->nullable();

            $table->boolean('emergencias')->nullable();
            $table->boolean('emergencias_cad')->nullable();
            $table->boolean('emergencias_edt')->nullable();
            $table->boolean('emergencias_del')->nullable();

            $table->boolean('usuarios')->nullable();
            $table->boolean('usuarios_cad')->nullable();
            $table->boolean('usuarios_edt')->nullable();
            $table->boolean('usuarios_del')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('perfis');
        Schema::enableForeignKeyConstraints();
    }
};
