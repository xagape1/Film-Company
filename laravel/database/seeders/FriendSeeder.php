<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class FriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('friend')->insert([
            [
                'id_profile1' => 1,
                'id_profile2' => 2,
                'friendship_date' => Carbon::now()
            ],
            [
                'id_profile1' => 2,
                'id_profile2' => 3,
                'friendship_date' => Carbon::now()
            ],
            [
                'id_profile1' => 3,
                'id_profile2' => 1,
                'friendship_date' => Carbon::now()
            ],
        ]);
    }
}