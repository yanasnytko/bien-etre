<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            // Clé étrangère vers l'utilisateur
            $table->unsignedBigInteger('user_id');

            // Colonnes pour la relation polymorphe
            $table->morphs('favoriteable'); // Crée favoriteable_id (unsignedBigInteger) et favoriteable_type (string)

            $table->timestamps();

            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
