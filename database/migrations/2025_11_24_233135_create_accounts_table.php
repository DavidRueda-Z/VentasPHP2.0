<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('accounts', function (Blueprint $table) {
        $table->id();

        // Turno al que pertenece esta cuenta
        $table->foreignId('shift_id')->constrained('shifts')->onDelete('cascade');

        // Nombre o identificador de la cuenta (Mesa 1, Mesa 2, Cuenta A, etc.)
        $table->string('name');

        // Estado de la cuenta
        $table->enum('status', ['open', 'closed'])->default('open');

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
