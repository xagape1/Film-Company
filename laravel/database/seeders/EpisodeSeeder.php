<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('episodes')->insert([
            [
                'serie_id' => 1,
                'title' => 'Episode 1',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'season' => 1,
                'duration' => '00:30:00',
                'files_id' => 1
            ],
            [
                'serie_id' => 1,
                'title' => 'Episode 2',
                'description' => 'Nulla venenatis ipsum eu arcu hendrerit, vitae bibendum sem maximus.',
                'season' => 1,
                'duration' => '00:45:00',
                'files_id' => 2
            ],
            [
                'serie_id' => 2,
                'title' => 'Episode 1',
                'description' => 'Praesent vel felis sit amet turpis pretium pellentesque vel id felis.',
                'season' => 1,
                'duration' => '00:20:00',
                'files_id' => 1
            ],
            [
                'serie_id' => 2,
                'title' => 'Episode 2',
                'description' => 'Praesent vel felis sit amet turpis pretium pellentesque vel id felis.',
                'season' => 1,
                'duration' => '00:30:00',
                'files_id' => 2
            ]
        ]);
    }
}