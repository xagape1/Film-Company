<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role')->insert([
            [
                'name' => 'Administrator',
                'description' => 'Has full access to the system',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular user',
                'description' => 'Has limited access to the system',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Subscribed user',
                'description' => 'Can acces all content to the system',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
