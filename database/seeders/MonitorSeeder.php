<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\Monitor;
use App\Models\BreachEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing teams by organization
        $techCorp = \App\Models\Organization::where('name', 'TechCorp Inc')->first();
        $financeBank = \App\Models\Organization::where('name', 'FinanceBank')->first();

        if ($techCorp) {
            $devTeam = $techCorp->teams()->where('name', 'Development Team')->first();
            $securityTeam = $techCorp->teams()->where('name', 'Security Team')->first();

            if ($devTeam) {
                // Check if monitors already exist for this team
                if ($devTeam->monitors()->count() === 0) {
                    // Add test monitors to Development Team
                    $monitors1 = $devTeam->monitors()->createMany([
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
                            'value' => 'security@techcorp.com',
                            'notes' => 'Security team email',
                            'is_active' => true,
                            'last_scanned_at' => now()->subMinutes(15),
                        ],
                        [
                            'type' => 'email',
                            'value' => 'hr@techcorp.com',
                            'notes' => 'Human Resources email',
                            'is_active' => false, // Disabled monitor
                            'last_scanned_at' => now()->subDays(5),
                        ],
                    ]);

                    // Add breach events for some monitors
                    $this->createBreachEvents($monitors1[0], 'TechCorp Inc', '2023-12-15', ['email', 'passwords', 'names', 'phone_numbers']);
                    $this->createBreachEvents($monitors1[1], 'LinkedIn Breach', '2021-06-22', ['email', 'passwords', 'names']);
                    $this->createBreachEvents($monitors1[2], 'Adobe Breach', '2013-10-04', ['email', 'passwords', 'names']);
                } else {
                    $this->command->info('Development Team already has monitors, skipping...');
                }
            }

            if ($securityTeam) {
                // Check if monitors already exist for this team
                if ($securityTeam->monitors()->count() === 0) {
                    // Add monitors to Security Team
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

                    // Add breach events for security team monitors
                    $this->createBreachEvents($securityMonitors[0], 'Yahoo Breach', '2013-08-01', ['email', 'passwords', 'names', 'phone_numbers']);
                    $this->createBreachEvents($securityMonitors[1], 'Equifax Breach', '2017-05-13', ['email', 'names', 'ssn', 'addresses']);
                } else {
                    $this->command->info('Security Team already has monitors, skipping...');
                }
            }
        }

        if ($financeBank) {
            $marketingTeam = $financeBank->teams()->where('name', 'Marketing Team')->first();

            if ($marketingTeam) {
                // Check if monitors already exist for this team
                if ($marketingTeam->monitors()->count() === 0) {
                    // Add test monitors to Marketing Team
                    $monitors2 = $marketingTeam->monitors()->createMany([
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

                    // Add breach events for marketing team monitors
                    $this->createBreachEvents($monitors2[0], 'FinanceBank Breach', '2023-11-28', ['email', 'passwords', 'names', 'phone_numbers']);
                    $this->createBreachEvents($monitors2[1], 'Facebook Breach', '2021-04-03', ['email', 'phone_numbers', 'names']);
                } else {
                    $this->command->info('Marketing Team already has monitors, skipping...');
                }
            }
        }

        $this->command->info('MonitorSeeder completed successfully!');
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
