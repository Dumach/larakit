<?php

namespace Database\Seeders;

use App\Models\Travel;
use App\Models\TravelSignup;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => true,
            'password' => 'test1234',
         ]);

        //  Travel::factory(10)->create();

        //  TravelSignup::factory(50)->create();

    }
}
