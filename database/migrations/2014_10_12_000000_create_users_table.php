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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('cpf', 11)->unique();
            $table->string('email', 100)->unique()->nullable();
            $table->string('telefone1', 11)->unique();
            $table->string('telefone2', 11)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100);

            $table->string('foto', 100)->nullable();

            $table->string('cep', 7)->nullable();
             $table->string('rua', 50)->nullable();
            $table->string('numero', 20)->nullable();
            $table->foreignId('bairro_id')->nullable()->constrained('bairros')->onUpdate('cascade')->onDelete('set null');

            $table->foreignId('perfil_id')->nullable()->constrained('perfis')->onUpdate('cascade')->onDelete('set null');

            $table->foreignId('created_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
        Schema::enableForeignKeyConstraints();
    }
};
