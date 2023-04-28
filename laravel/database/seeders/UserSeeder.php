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
        DB::table('users')->insert([

            [
                'name' => 'joel',
                'last_name' => 'galán',
                'email' => 'jogape@fp.insjoaquimmir.cat',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('12345678'),
                'date_of_birthday' => Carbon::parse('1990-01-01'),
                'date_creation' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'holaquetal',
                'last_name' => 'adiosquetal',
                'email' => 'holaquetal@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('12345678'),
                'date_of_birthday' => Carbon::parse('1995-05-05'),
                'date_creation' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'prova',
                'last_name' => 'proveta',
                'email' => 'provacio@gmail.com',
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make('12345678'),
                'date_of_birthday' => Carbon::parse('1995-05-05'),
                'date_creation' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        $admin = new User([
            'name' => env('ADMIN_NAME'),
            'last_name' => 'Galán',
            'email' => env('ADMIN_EMAIL'),
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make(env('ADMIN_PASSWORD')),
            'date_of_birthday' => Carbon::parse('2003-05-17'),
            'date_creation' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $admin->save();

    }
}
;