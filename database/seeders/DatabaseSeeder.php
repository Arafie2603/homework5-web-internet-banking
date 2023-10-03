<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Accounts;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

       User::create([
        'name' => 'Arafie Setiawan',
        'email' => 'ara@gmail.com',
        'password' => bcrypt('123'),
       ]);

       Accounts::create([
        'amount' => 20000,
        'address' => 'Jl. Cipsasa',
        'user_id' => 1
       ]);
    }
}
