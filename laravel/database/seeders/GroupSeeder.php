<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group')->insert([
            [
                'id_chat' => 1,
                'name' => 'Grupo de amigos',
                'capacity' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_chat' => 2,
                'name' => 'Grupo de trabajo',
                'capacity' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
