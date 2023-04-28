<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Friend;
use App\Models\Profile;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friend', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('id_profile1')->unsigned();
            $table->BigInteger('id_profile2')->unsigned();
            $table->date('friendship_date')->nullable();
            $table->timestamps();
            $table->foreign('id_profile1')->references('id')->on('profile');
            $table->foreign('id_profile2')->references('id')->on('profile');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friend');
    }
};
