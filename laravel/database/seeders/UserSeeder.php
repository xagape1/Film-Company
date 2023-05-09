<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run()
    {
        $admin = new User([
            'name' => env('ADMIN_NAME'),
            'email' => env('ADMIN_EMAIL'),
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make(env('ADMIN_PASSWORD')),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $admin->save();
    }
}
;