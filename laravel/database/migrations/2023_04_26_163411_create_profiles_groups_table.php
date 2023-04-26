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
        Schema::create('profiles_groups', function (Blueprint $table) {
            $table->unsignedBigInteger('id_profile');
            $table->unsignedBigInteger('id_group');
            $table->primary(['id_profile', 'id_group']);
            $table->foreign('id_profile')->references('id')->on('profile')->onDelete('cascade');
            $table->foreign('id_group')->references('id')->on('group')->onDelete('cascade');
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
        Schema::dropIfExists('profiles_groups');
    }
};
