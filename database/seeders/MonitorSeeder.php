<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Monitor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing teams
        $team1 = Team::where('name', 'Development Team')->first();
        $team2 = Team::where('name', 'Marketing Team')->first();

        if ($team1) {
            // Add test monitors to Development Team
            $team1->monitors()->createMany([
                [
                    'type' => 'email',
                    'value' => 'admin@example.com',
                    'notes' => 'Primary admin email',
                    'is_active' => true,
                ],
                [
                    'type' => 'email',
                    'value' => 'john@example.com',
                    'notes' => 'Team lead email',
                    'is_active' => true,
                ],
                [
                    'type' => 'domain',
                    'value' => 'example.com',
                    'notes' => 'Company domain',
                    'is_active' => true,
                ],
                [
                    'type' => 'email',
                    'value' => 'dev@example.com',
                    'notes' => 'Development team email',
                    'is_active' => true,
                ],
            ]);
        }

        if ($team2) {
            // Add test monitors to Marketing Team
            $team2->monitors()->createMany([
                [
                    'type' => 'email',
                    'value' => 'marketing@example.com',
                    'notes' => 'Marketing team email',
                    'is_active' => true,
                ],
                [
                    'type' => 'domain',
                    'value' => 'marketing.example.com',
                    'notes' => 'Marketing subdomain',
                    'is_active' => true,
                ],
            ]);
        }

        $this->command->info('Test monitors seeded successfully!');
    }
}
