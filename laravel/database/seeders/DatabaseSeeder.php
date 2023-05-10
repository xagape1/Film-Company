<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Artisan::call('db:seed', [
            '--class' => 'RoleSeeder',
            '--force' => true // <--- add this line
        ]);
        Artisan::call('db:seed', [
            '--class' => 'UserSeeder',
            '--force' => true // <--- add this line
        ]);
        Artisan::call('db:seed', [
            '--class' => 'FilesSeeder',
            '--force' => true // <--- add this line
        ]);
        Artisan::call('db:seed', [
            '--class' => 'ProfileSeeders', 
            '--force' => true // <--- add this line
        ]);
        Artisan::call('db:seed', [
            '--class' => 'FriendSeeder',
            '--force' => true // <--- add this line
        ]);
        Artisan::call('db:seed', [
            '--class' => 'ChatSeeders', 
            '--force' => true // <--- add this line
        ]);
        Artisan::call('db:seed', [
            '--class' => 'MessageSeeders',
            '--force' => true // <--- add this line
        ]);
        Artisan::call('db:seed', [
            '--class' => 'GroupSeeder',
            '--force' => true // <--- add this line
        ]);
        Artisan::call('db:seed', [
            '--class' => 'ProfileGroupSeeder',
            '--force' => true // <--- add this line
        ]);
        Artisan::call('db:seed', [
            '--class' => 'SerieSeeder',
            '--force' => true // <--- add this line
        ]);
        Artisan::call('db:seed', [
            '--class' => 'MoviesSeeder',
            '--force' => true // <--- add this line
        ]);
        Artisan::call('db:seed', [
            '--class' => 'EpisodeSeeder',
            '--force' => true // <--- add this line
        ]);
        Artisan::call('db:seed', [
            '--class' => 'CollectionSeeder',            '--force' => true // <--- add this line
        ]);
        Artisan::call('db:seed', [
            '--class' => 'ReviewSeeder',
            '--force' => true // <--- add this line
        ]);

    }
}
