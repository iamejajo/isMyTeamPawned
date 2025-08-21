<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Organization;
use App\Models\Team;
use App\Models\Monitor;
use App\Models\BreachEvent;
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
        // Create test users
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@techcorp.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin', // Organization creator
        ]);

        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@techcorp.com',
            'password' => Hash::make('password'),
            'role' => 'client', // Team member
        ]);

        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@techcorp.com',
            'password' => Hash::make('password'),
            'role' => 'client', // Team member
        ]);

        $user3 = User::create([
            'name' => 'Mike Johnson',
            'email' => 'mike.johnson@financebank.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin', // Organization creator
        ]);

        // Create test organizations
        $techCorp = Organization::create([
            'name' => 'TechCorp Inc',
            'owner_id' => $admin->id,
        ]);

        $financeBank = Organization::create([
            'name' => 'FinanceBank',
            'owner_id' => $user3->id,
        ]);

        // Create test teams
        $devTeam = Team::create([
            'name' => 'Development Team',
            'organization_id' => $techCorp->id,
        ]);

        $securityTeam = Team::create([
            'name' => 'Security Team',
            'organization_id' => $techCorp->id,
        ]);

        $marketingTeam = Team::create([
            'name' => 'Marketing Team',
            'organization_id' => $financeBank->id,
        ]);

        // Add users to teams with different roles
        $devTeam->users()->attach($admin->id, ['role' => 'owner']);
        $devTeam->users()->attach($user1->id, ['role' => 'admin']);
        $devTeam->users()->attach($user2->id, ['role' => 'member']);

        $securityTeam->users()->attach($admin->id, ['role' => 'owner']);
        $securityTeam->users()->attach($user1->id, ['role' => 'member']);

        $marketingTeam->users()->attach($user3->id, ['role' => 'owner']);
        $marketingTeam->users()->attach($user2->id, ['role' => 'admin']);

        // Add comprehensive test monitors
        $devMonitors = $devTeam->monitors()->createMany([
            [
                'type' => 'email',
                'value' => 'admin@techcorp.com',
                'notes' => 'Primary admin email for TechCorp Inc',
                'is_active' => true,
                'last_scanned_at' => now()->subHours(2),
            ],
            [
                'type' => 'email',
                'value' => 'john.doe@techcorp.com',
                'notes' => 'Senior Developer email',
                'is_active' => true,
                'last_scanned_at' => now()->subHours(1),
            ],
            [
                'type' => 'email',
                'value' => 'dev.team@techcorp.com',
                'notes' => 'Development team shared email',
                'is_active' => true,
                'last_scanned_at' => now()->subMinutes(30),
            ],
            [
                'type' => 'domain',
                'value' => 'techcorp.com',
                'notes' => 'Main company domain',
                'is_active' => true,
                'last_scanned_at' => now()->subHours(3),
            ],
            [
                'type' => 'email',
                'value' => 'api@techcorp.com',
                'notes' => 'API service email',
                'is_active' => true,
                'last_scanned_at' => now()->subMinutes(15),
            ],
        ]);

        $securityMonitors = $securityTeam->monitors()->createMany([
            [
                'type' => 'email',
                'value' => 'security@techcorp.com',
                'notes' => 'Security team email',
                'is_active' => true,
                'last_scanned_at' => now()->subMinutes(15),
            ],
            [
                'type' => 'email',
                'value' => 'incident@techcorp.com',
                'notes' => 'Security incident response email',
                'is_active' => true,
                'last_scanned_at' => now()->subHours(1),
            ],
            [
                'type' => 'domain',
                'value' => 'secure.techcorp.com',
                'notes' => 'Secure subdomain',
                'is_active' => true,
                'last_scanned_at' => now()->subHours(4),
            ],
        ]);

        $marketingMonitors = $marketingTeam->monitors()->createMany([
            [
                'type' => 'email',
                'value' => 'marketing@financebank.com',
                'notes' => 'Marketing team email for FinanceBank',
                'is_active' => true,
                'last_scanned_at' => now()->subHours(4),
            ],
            [
                'type' => 'email',
                'value' => 'social@financebank.com',
                'notes' => 'Social media team email',
                'is_active' => true,
                'last_scanned_at' => now()->subHours(2),
            ],
            [
                'type' => 'domain',
                'value' => 'financebank.com',
                'notes' => 'Main banking domain',
                'is_active' => true,
                'last_scanned_at' => now()->subHours(6),
            ],
            [
                'type' => 'email',
                'value' => 'pr@financebank.com',
                'notes' => 'Public Relations email',
                'is_active' => true,
                'last_scanned_at' => now()->subMinutes(45),
            ],
        ]);

        // Add realistic breach events
        $this->createBreachEvents($devMonitors[0], 'TechCorp Inc', '2023-12-15', ['email', 'passwords', 'names', 'phone_numbers']);
        $this->createBreachEvents($devMonitors[1], 'LinkedIn Breach', '2021-06-22', ['email', 'passwords', 'names']);
        $this->createBreachEvents($devMonitors[2], 'Adobe Breach', '2013-10-04', ['email', 'passwords', 'names']);
        $this->createBreachEvents($devMonitors[3], 'Dropbox Breach', '2012-07-01', ['email', 'passwords']);

        $this->createBreachEvents($securityMonitors[0], 'Yahoo Breach', '2013-08-01', ['email', 'passwords', 'names', 'phone_numbers']);
        $this->createBreachEvents($securityMonitors[1], 'Equifax Breach', '2017-05-13', ['email', 'names', 'ssn', 'addresses']);

        $this->createBreachEvents($marketingMonitors[0], 'FinanceBank Breach', '2023-11-28', ['email', 'passwords', 'names', 'phone_numbers']);
        $this->createBreachEvents($marketingMonitors[1], 'Facebook Breach', '2021-04-03', ['email', 'phone_numbers', 'names']);
        $this->createBreachEvents($marketingMonitors[2], 'Marriott Breach', '2018-09-10', ['email', 'passport_numbers', 'names']);

        $this->command->info('Comprehensive test data seeded successfully!');
        $this->command->info('Super Admin 1: admin@techcorp.com / password (TechCorp Inc owner)');
        $this->command->info('Client 1: john.doe@techcorp.com / password (TechCorp team member)');
        $this->command->info('Client 2: jane.smith@techcorp.com / password (TechCorp team member)');
        $this->command->info('Super Admin 2: mike.johnson@financebank.com / password (FinanceBank owner)');
        $this->command->info('');
        $this->command->info('Organizations: TechCorp Inc, FinanceBank');
        $this->command->info('Teams: Development Team, Security Team, Marketing Team');
        $this->command->info('Monitors: 12 active monitors with realistic breach events');
        $this->command->info('');
        $this->command->info('Role Structure:');
        $this->command->info('- super_admin: Organization creators (can access admin panel)');
        $this->command->info('- client: Team members (access company panel only)');
    }

    private function createBreachEvents($monitor, $breachName, $breachDate, $dataClasses)
    {
        $monitor->breachEvents()->create([
            'breach_name' => $breachName,
            'breach_date' => $breachDate,
            'data_classes' => $dataClasses,
            'description' => "This breach exposed sensitive data including " . implode(', ', $dataClasses) . ".",
            'source' => 'hibp',
            'added_at' => now()->subDays(rand(1, 30)),
            'is_new' => rand(0, 1) == 1, // Randomly mark some as new
        ]);
    }
}
