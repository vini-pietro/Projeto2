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
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // ID do evento
            $table->foreignId('group_id')->constrained()->onDelete('cascade'); // Relacionamento com grupos
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relacionamento com o usuário criador
            $table->string('name'); // Nome do evento
            $table->text('description')->nullable(); // Descrição do evento (opcional)
            $table->dateTime('date'); // Data e hora do evento
            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
