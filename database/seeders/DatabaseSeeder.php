<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $testUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'Hesloje123',
        ]);

        Task::factory()->count(10)->create([
            'user_id' => $testUser->id,
        ]);

        User::factory()
            ->count(5)
            ->create()
            ->each(function($user){
                Task::factory()
                    ->count(rand(3, 8))
                    ->create(['user_id'=>$user->id]);
            });
    }
}
