<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chat')->insert([
            [
                'id_profile1' => 1,
                'id_profile2' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_profile1' => 1,
                'id_profile2' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
