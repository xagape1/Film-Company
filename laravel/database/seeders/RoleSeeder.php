<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'id' => Role::BASIC,
            'name' => 'basic',
            'guard_name' => 'web'
        ]);
    
        Role::create([
            'id' => Role::COMPANY,
            'name' => 'company',
            'guard_name' => 'web'
        ]);
    
        Role::create([
            'id' => Role::ADMIN,
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
    }
    
}
