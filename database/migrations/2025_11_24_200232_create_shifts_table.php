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
    Schema::create('shifts', function (Blueprint $table) {
        $table->id();

        // Usuario dueño del turno
        $table->foreignId('user_id')->constrained()->onDelete('cascade');

        // Monto inicial con el que inicia el turno
        $table->decimal('initial_amount', 10, 2);

        // Total recaudado al cerrar el turno (NULL mientras el turno sigue abierto)
        $table->decimal('total_sales', 10, 2)->nullable();

        // Monto final al cerrar el turno
        $table->decimal('final_amount', 10, 2)->nullable();

        // Estado del turno
        $table->enum('status', ['open', 'closed'])->default('open');

        // Fechas de inicio y cierre
        $table->timestamp('opened_at')->nullable();
        $table->timestamp('closed_at')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
