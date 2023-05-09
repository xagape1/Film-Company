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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_profile');
            $table->unsignedBigInteger('id_movies')->nullable();
            $table->unsignedBigInteger('id_episodes')->nullable();
            $table->string('name');
            $table->timestamps();

            $table->foreign('id_profile')->references('id')->on('profile')->onDelete('cascade');
            $table->foreign('id_movies')->references('id')->on('movies')->onDelete('cascade');
            $table->foreign('id_episodes')->references('id')->on('episodes')->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collection');
    }
};
