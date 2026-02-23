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
       Schema::create('endress', function (Blueprint $table) {
            $table->id('endress_id');
            $table->string('endress_photo', 500)->nullable();
            $table->integer('endress_StreetNumber');
            $table->string('endress_street', 100);
            $table->string('endress_StreetExtra', 200)->nullable();
            $table->integer('endress_cep');
            $table->integer('endress_user'); 
            $table->foreignId('usuarios_user_id')->constrained('users'); 
            $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('endress');
    }
};
