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
        Schema::create('sale_log', function (Blueprint $table) {
            $table->id('sale_id');
            $table->string('sale_ProductPhoto', 500)->nullable();
            $table->string('sale_ProductName', 200);
            $table->integer('sale_ProductValue');
            $table->dateTime('sale_data');
            $table->string('sale_client', 200);
            $table->string('sale_autor', 200);
            $table->foreignId('usuarios_user_id')->constrained('users');
            $table->foreignId('product_product_id')->constrained('product');
            $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_log');
    }
};
