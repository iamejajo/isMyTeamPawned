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
        // Create test users
        $siteAdmin = User::create([
            'name' => 'Site Admin',
            'email' => 'admin@ismyteampwned.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin', // Site admin (SaaS owner)
        ]);

        $orgOwner1 = User::create([
            'name' => 'John Doe',
            'email' => 'john.doe@techcorp.com',
            'password' => Hash::make('password'),
            'role' => 'client', // Organization owner
        ]);

        $orgMember1 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@techcorp.com',
            'password' => Hash::make('password'),
            'role' => 'client', // Organization member
        ]);

        $orgOwner2 = User::create([
            'name' => 'Mike Johnson',
            'email' => 'mike.johnson@financebank.com',
            'password' => Hash::make('password'),
            'role' => 'client', // Organization owner
        ]);

        // Create test organizations
        $techCorp = Organization::create([
            'name' => 'TechCorp Inc',
            'owner_id' => $orgOwner1->id,
        ]);

        $financeBank = Organization::create([
            'name' => 'FinanceBank',
            'owner_id' => $orgOwner2->id,
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
        $devTeam->users()->attach($orgOwner1->id, ['role' => 'owner']);
        $devTeam->users()->attach($orgMember1->id, ['role' => 'admin']);

        $securityTeam->users()->attach($orgOwner1->id, ['role' => 'owner']);
        $securityTeam->users()->attach($orgMember1->id, ['role' => 'member']);

        $marketingTeam->users()->attach($orgOwner2->id, ['role' => 'owner']);
        $marketingTeam->users()->attach($orgMember1->id, ['role' => 'admin']);

        // Note: Monitors will be created by MonitorSeeder to avoid duplication

        $this->command->info('Comprehensive test data seeded successfully!');
        $this->command->info('Site Admin: admin@ismyteampwned.com / password (SaaS owner)');
        $this->command->info('Org Owner 1: john.doe@techcorp.com / password (TechCorp Inc owner)');
        $this->command->info('Org Member 1: jane.smith@techcorp.com / password (TechCorp team member)');
        $this->command->info('Org Owner 2: mike.johnson@financebank.com / password (FinanceBank owner)');
        $this->command->info('');
        $this->command->info('Organizations: TechCorp Inc, FinanceBank');
        $this->command->info('Teams: Development Team, Security Team, Marketing Team');
        $this->command->info('Monitors: Will be created by MonitorSeeder');
        $this->command->info('');
        $this->command->info('Role Structure:');
        $this->command->info('- super_admin: Site admin (SaaS owner) - can access admin panel');
        $this->command->info('- client: All organization users - can access company panel');
        $this->command->info('Team Roles:');
        $this->command->info('- owner: Organization creator');
        $this->command->info('- admin: Invited admin');
        $this->command->info('- member: Invited member');
    }
}
