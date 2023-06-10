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
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('filepath', 255);
            $table->integer('filesize')->default(0);
            $table->unsignedBigInteger('cover_id')->nullable();
            $table->unsignedBigInteger('intro_id')->nullable();
            $table->timestamps();

            $table->foreign('cover_id')->references('id')->on('files');
            $table->foreign('intro_id')->references('id')->on('files');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
};
