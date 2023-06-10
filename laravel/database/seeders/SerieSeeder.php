<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SerieSeeder extends Seeder
{
    public function run()
    {
        DB::table('serie')->insert([
            [
                'title' => 'Game of Thrones',
                'description' => 'Game of Thrones is an American fantasy drama television series created by David Benioff and D. B. Weiss for HBO.',
                'gender' => 'Fantasy',
                'seasons' => 8,
                'episodes' => 73,
                'cover_id' => 1, // ID del primer registro en la tabla files
                'intro_id' => 1, // ID del segundo registro en la tabla files
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Breaking Bad',
                'description' => 'Breaking Bad is an American neo-Western crime drama television series created and produced by Vince Gilligan.',
                'gender' => 'Crime drama',
                'seasons' => 5,
                'episodes' => 62,
                'cover_id' => 2, // ID del tercer registro en la tabla files
                'intro_id' => 2, // ID del cuarto registro en la tabla files
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'The Sopranos',
                'description' => 'The Sopranos is an American crime drama television series created by David Chase.',
                'gender' => 'Crime drama',
                'seasons' => 6,
                'episodes' => 86,
                'cover_id' => 3, // ID del quinto registro en la tabla files
                'intro_id' => 3, // ID del sexto registro en la tabla files
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
