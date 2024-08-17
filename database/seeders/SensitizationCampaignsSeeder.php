<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SensitizationCampaignsSeeder extends Seeder
{
    public function run()
    {
        DB::table('sensitization_campaigns')->insert([
            [
                'title' => 'Jadili Health Awareness Campaign',
                'description' => 'A campaign to raise awareness about health issues and provide essential information to the public through USSD.',
                'start_date' => now(),
                'end_date' => now()->addDays(7),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Jadili Public Service Information Campaign',
                'description' => 'A campaign aimed at informing the public about various government services and how to access them via USSD.',
                'start_date' => now()->addDays(1),
                'end_date' => now()->addDays(8),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Jadili Education and Training Campaign',
                'description' => 'A campaign focused on providing educational materials and training opportunities to the public through the USSD platform.',
                'start_date' => now()->addDays(2),
                'end_date' => now()->addDays(9),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Jadili Community Engagement Campaign',
                'description' => 'A campaign to engage local communities in discussions about their needs and how government programs can address them.',
                'start_date' => now()->addDays(3),
                'end_date' => now()->addDays(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Jadili Feedback and Reporting Campaign',
                'description' => 'A campaign encouraging the public to provide feedback and report issues directly via USSD, fostering better communication between citizens and the government.',
                'start_date' => now()->addDays(4),
                'end_date' => now()->addDays(11),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
