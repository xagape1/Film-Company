<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntroTable extends Migration
{
    public function up()
    {
        Schema::create('intro', function (Blueprint $table) {
            $table->id();
            $table->string('filepath');
            $table->integer('filesize')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('intro');
    }
}
