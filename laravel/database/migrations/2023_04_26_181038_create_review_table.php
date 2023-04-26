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
            $table->unsignedBigInteger('id_movie')->nullable();
            $table->unsignedBigInteger('id_serie')->nullable();
            $table->unsignedBigInteger('id_profile');
            $table->string('review');
            $table->timestamps();

            $table->foreign('id_movie')->references('id')->on('movie')->onDelete('cascade');
            $table->foreign('id_serie')->references('id')->on('serie')->onDelete('cascade');
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
