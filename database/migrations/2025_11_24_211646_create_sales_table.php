<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
    $table->id();

    $table->foreignId('shift_id')->constrained('shifts')->onDelete('cascade');
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('product_id')->constrained('products')->onDelete('cascade');

    $table->string('description')->nullable();
    $table->decimal('amount', 10, 2);

    $table->integer('quantity');
    $table->decimal('total_amount', 10, 2);

    $table->timestamp('sold_at')->nullable();

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};

