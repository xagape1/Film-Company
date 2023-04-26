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
        Schema::create('chat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_profile1');
            $table->unsignedBigInteger('id_profile2');
            $table->timestamps();

            $table->unique(['id_profile1', 'id_profile2']);
            $table->foreign('id_profile1')->references('id')->on('profile')->onDelete('cascade');
            $table->foreign('id_profile2')->references('id')->on('profile')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
};
