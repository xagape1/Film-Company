<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoverSeeder extends Seeder
{
    public function run()
    {
        DB::table('cover')->insert([
            [
                'filepath' => 'public/img/cover1.jpg',
                'filesize' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'filepath' => 'public/img/cover2.jpg',
                'filesize' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'filepath' => 'public/img/cover3.jpg',
                'filesize' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
