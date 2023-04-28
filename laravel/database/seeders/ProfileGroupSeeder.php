<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles_groups')->insert([
            [
                'id_profile' => 1,
                'id_group' => 1

            ],
            [
                'id_profile' => 2,
                'id_group' => 1
            ],
            [
                'id_profile' => 1,
                'id_group' => 2
            ],
            [
                'id_profile' => 2,
                'id_group' => 2
            ]
        ]);
    }
}