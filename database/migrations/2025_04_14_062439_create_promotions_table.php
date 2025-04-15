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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_provider_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('pdf', 255)->nullable();
            $table->dateTime('date_start');
            $table->dateTime('date_end');
            $table->dateTime('display_start');
            $table->dateTime('display_end');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('service_provider_id')
                  ->references('id')
                  ->on('service_providers')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
