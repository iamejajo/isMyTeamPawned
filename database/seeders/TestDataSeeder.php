<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Organization;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //test users
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
        ]);

        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
        ]);

        //test organization
        $organization = Organization::create([
            'name' => 'Test Organization',
            'owner_id' => $admin->id,
        ]);

        //test team
        $team = Team::create([
            'name' => 'Development Team',
            'organization_id' => $organization->id,
        ]);

        // Add users to team with different roles
        $team->users()->attach($admin->id, ['role' => 'owner']);
        $team->users()->attach($user1->id, ['role' => 'admin']);
        $team->users()->attach($user2->id, ['role' => 'member']);

        $organization2 = Organization::create([
            'name' => 'Another Organization',
            'owner_id' => $user1->id,
        ]);

        $team2 = Team::create([
            'name' => 'Marketing Team',
            'organization_id' => $organization2->id,
        ]);

        $team2->users()->attach($user1->id, ['role' => 'owner']);
        $team2->users()->attach($user2->id, ['role' => 'member']);

        $this->command->info('Test data seeded successfully!');
        $this->command->info('Admin: admin@example.com / password');
        $this->command->info('User 1: john@example.com / password');
        $this->command->info('User 2: jane@example.com / password');
    }
}
