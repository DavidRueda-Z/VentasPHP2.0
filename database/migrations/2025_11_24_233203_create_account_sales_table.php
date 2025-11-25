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
    Schema::create('account_sales', function (Blueprint $table) {
        $table->id();

        // Relación con la cuenta
        $table->foreignId('account_id')->constrained('accounts')->onDelete('cascade');

        // Producto vendido
        $table->foreignId('product_id')->constrained('products')->onDelete('cascade');

        // Datos de la venta
        $table->integer('quantity');
        $table->decimal('amount', 10, 2);       // precio unitario
        $table->decimal('total_amount', 10, 2); // cantidad x precio
        $table->timestamp('sold_at')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_sales');
    }
};
