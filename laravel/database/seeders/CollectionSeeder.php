<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('collections')->insert([
            [
                'id_profile' => 1,
                'id_movies' => 1,
                'id_episodes' => null,
                'name' => 'My favorite movies',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_profile' => 1,
                'id_movies' => null,
                'id_episodes' => 1,
                'name' => 'My favorite TV shows',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_profile' => 2,
                'id_movies' => 2,
                'id_episodes' => null,
                'name' => 'Action movies',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_profile' => 2,
                'id_movies' => 3,
                'id_episodes' => null,
                'name' => 'Romantic comedies',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_profile' => 3,
                'id_movies' => 4,
                'id_episodes' => null,
                'name' => 'Horror movies',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
