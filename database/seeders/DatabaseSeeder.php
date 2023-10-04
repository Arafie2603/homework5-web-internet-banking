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
        'amount' => 200000,
        'address' => 'Jl. Tangerang Selatan',
        'password' => bcrypt('123'),
        'image' => '',
       ]);
       User::create([
        'name' => 'Zeastca',
        'email' => 'zest@gmail.com',
        'amount' => 400000,
        'address' => 'Jl. Tangerang Barat',
        'password' => bcrypt('123'),
        'image' => '',
       ]);
    }
}
