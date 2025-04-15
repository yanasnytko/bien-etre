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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street', 255); 
            $table->string('number', 10)->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('localite_id');
            $table->timestamps();

            $table->foreign('localite_id')
                  ->references('id')
                  ->on('localites')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
