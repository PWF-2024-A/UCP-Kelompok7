<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create(
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'is_admin' => true,
            ]
        );
        User::factory()->create(
            [
                'name' => 'Fahma Rosyidah',
                'email' => 'fahma@gmail.com',
                'is_admin' => true,
            ]
        );

        User::factory(100)->create();
        Todo::factory(500)->create();
    }
}
