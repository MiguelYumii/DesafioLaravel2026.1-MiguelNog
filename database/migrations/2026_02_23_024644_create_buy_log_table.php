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
        Schema::create('buy_log', function (Blueprint $table) {
            $table->id('buy_id');
            $table->string('buy_ProductPhoto', 500)->nullable();
            $table->string('buy_ProductName', 200);
            $table->integer('buy_ProductValue');
            $table->dateTime('buy_data');
            $table->string('buy_autor', 200);
            $table->string('buy_client', 200);
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
        Schema::dropIfExists('buy_log');
    }
};
