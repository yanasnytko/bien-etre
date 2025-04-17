<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_provider_service', function (Blueprint $table) {
            $table->unsignedBigInteger('service_provider_id');
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_provider_id')
                  ->references('id')->on('service_providers')
                  ->onDelete('cascade');
            $table->foreign('service_id')
                  ->references('id')->on('services')
                  ->onDelete('cascade');
            $table->primary(['service_provider_id','service_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_provider_service');
    }
};
