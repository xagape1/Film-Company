<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('serie')->insert([
            [
                'title' => 'Game of Thrones',
                'description' => 'Game of Thrones is an American fantasy drama television series created by David Benioff and D. B. Weiss for HBO.',
                'gender' => 'Fantasy',
                'seasons' => 8,
                'episodes' => 73,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Breaking Bad',
                'description' => 'Breaking Bad is an American neo-Western crime drama television series created and produced by Vince Gilligan.',
                'gender' => 'Crime drama',
                'seasons' => 5,
                'episodes' => 62,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Sopranos',
                'description' => 'The Sopranos is an American crime drama television series created by David Chase.',
                'gender' => 'Crime drama',
                'seasons' => 6,
                'episodes' => 86,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
