<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('review')->insert([
            [
                'id_movies' => 1,
                'id_profile' => 1,
                'review' => 'This movie was great!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_serie' => 1,
                'id_profile' => 2,
                'review' => 'I loved this series! The characters were amazing.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_movies' => 2,
                'id_profile' => 3,
                'review' => 'Disappointing movie. Would not recommend.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_serie' => 2,
                'id_profile' => 3,
                'review' => 'This series was just okay. Not great, not terrible.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
