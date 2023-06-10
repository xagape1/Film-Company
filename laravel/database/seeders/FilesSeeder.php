<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilesSeeder extends Seeder
{
    public function run()
    {
        DB::table('files')->insert([
            [
                'filepath' => 'public/img/suu.mp4',
                'filesize' => 1024,
                'cover_id' => null,
                'intro_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'filepath' => 'public/img/messi.mp4',
                'filesize' => 2048,
                'cover_id' => null,
                'intro_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'filepath' => 'public/img/ronaldo.mp4',
                'filesize' => 4096,
                'cover_id' => null,
                'intro_id' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
