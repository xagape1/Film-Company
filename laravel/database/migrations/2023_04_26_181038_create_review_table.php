<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_movies')->nullable();
            $table->unsignedBigInteger('id_episode')->nullable();
            $table->unsignedBigInteger('id_profile');
            $table->string('review');
            $table->timestamps();

            $table->foreign('id_movies')->references('id')->on('movies')->onDelete('cascade');
            $table->foreign('id_episode')->references('id')->on('episode')->onDelete('cascade');
            $table->foreign('id_profile')->references('id')->on('profile')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review');
    }
};
