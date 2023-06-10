<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IntroSeeder extends Seeder
{
    public function run()
    {
        DB::table('intro')->insert([
            [
                'filepath' => 'public/videos/intro1.mp4',
                'filesize' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'filepath' => 'public/videos/intro2.mp4',
                'filesize' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'filepath' => 'public/videos/intro3.mp4',
                'filesize' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
