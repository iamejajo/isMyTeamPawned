<?php

namespace Database\Seeders;

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
        // Call seeders in the correct order
        $this->call([
            TestDataSeeder::class,    // Creates users, organizations, teams, and basic monitors
            MonitorSeeder::class,     // Adds additional monitors and breach events
        ]);

        $this->command->info('All seeders completed successfully!');
        $this->command->info('');
        $this->command->info('=== Test Accounts ===');
        $this->command->info('Site Admin: admin@ismyteampwned.com / password (SaaS owner)');
        $this->command->info('Org Owner 1: john.doe@techcorp.com / password (TechCorp Inc owner)');
        $this->command->info('Org Member 1: jane.smith@techcorp.com / password (TechCorp team member)');
        $this->command->info('Org Owner 2: mike.johnson@financebank.com / password (FinanceBank owner)');
        $this->command->info('');
        $this->command->info('=== Dashboard Access ===');
        $this->command->info('Site Admin: /admin (Admin Panel)');
        $this->command->info('Organization Users: /company (Company Panel)');
        $this->command->info('');
        $this->command->info('=== Organizations & Teams ===');
        $this->command->info('TechCorp Inc: Development Team, Security Team');
        $this->command->info('FinanceBank: Marketing Team');
        $this->command->info('');
        $this->command->info('=== Monitoring Data ===');
        $this->command->info('12 active monitors with realistic breach events');
        $this->command->info('Multiple breach events per monitor');
        $this->command->info('Realistic data classes and breach dates');
        $this->command->info('');
        $this->command->info('=== Role Structure ===');
        $this->command->info('User Roles:');
        $this->command->info('- super_admin: Site admin (SaaS owner)');
        $this->command->info('- client: All organization users');
        $this->command->info('Team Roles:');
        $this->command->info('- owner: Organization creator');
        $this->command->info('- admin: Invited admin');
        $this->command->info('- member: Invited member');
    }
}
