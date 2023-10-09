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
        Schema::create('denuncias', function (Blueprint $table) {
            $table->id();
            $table->integer('tipo');

            $table->string('vitima', 100)->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('set null');

            $table->string('agressor', 100)->nullable();
            $table->foreignId('agressor_id')->nullable()->constrained('agressores')->onUpdate('cascade')->onDelete('set null');

            $table->string('rua', 50)->nullable();
            $table->string('numero', 20)->nullable();
            $table->foreignId('bairro_id')->nullable()->constrained('bairros')->onUpdate('cascade')->onDelete('set null');

            $table->text('narrativa');

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
        Schema::dropIfExists('denuncias');
    }
};
