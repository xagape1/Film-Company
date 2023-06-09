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
        Schema::create('serie', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('gender');
            $table->integer('seasons');
            $table->integer('episodes');
            $table->unsignedBigInteger('cover_id');
            $table->foreign('cover_id')->references('id')->on('cover');

            $table->unsignedBigInteger('intro_id');
            $table->foreign('intro_id')->references('id')->on('intro');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serie');
    }
};
