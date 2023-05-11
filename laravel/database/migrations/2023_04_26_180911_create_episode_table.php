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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_serie')->default(0);
            $table->string('title');
            $table->text('description');
            $table->integer('season');
            $table->time('duration');
            $table->unsignedBigInteger('files_id');
            $table->timestamps();
            
            $table->foreign('files_id')->references('id')->on('files');
            
            $table->foreign('id_serie')->references('id')->on('serie');
        });
        
    }
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodes');
    }
};
