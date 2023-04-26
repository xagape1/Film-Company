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
        Schema::create('role_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');
            $table->timestamps();
    
            $table->primary(['user_id', 'role_id']);
            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('role')->onDelete('cascade');
        });
    }
    
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_users');
    }
};
