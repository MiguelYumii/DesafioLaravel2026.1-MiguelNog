<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Aqui está 'product' no singular!
        Schema::create('product', function (Blueprint $table) { 
            $table->id();
            $table->decimal('product_autor', 10, 2)->nullable(); 
            $table->string('product_AutorPhone')->nullable();
            $table->string('product_name');
            $table->decimal('product_value', 10, 2);
            $table->integer('product_stock');
            $table->text('product_description')->nullable();
            $table->string('product_category')->nullable();
            $table->string('product_image')->nullable();
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        // Aqui também está no singular!
        Schema::dropIfExists('product');
    }
};