<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create(['role' => 1, 'password' => 'cbxTEST']); // make sure at least 1 admin user is created
        User::factory()->count(9)->create();
    }
}
