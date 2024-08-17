<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublicEngagementsSeeder extends Seeder
{
    public function run()
    {
        DB::table('public_engagements')->insert([
            [
                'title' => 'Jadili Health Awareness Workshop',
                'description' => 'A workshop focused on educating the public about health issues and promoting health services available via USSD.',
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Jadili Public Services Seminar',
                'description' => 'A seminar aimed at providing information about government services and how to access them through USSD.',
                'date' => now()->addDays(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Jadili Community Engagement Forum',
                'description' => 'A forum designed to engage with local communities, discuss their needs, and explore how government programs can address them.',
                'date' => now()->addDays(4),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Jadili Educational Training Session',
                'description' => 'A training session offering educational materials and resources to the public via USSD, aimed at improving knowledge and skills.',
                'date' => now()->addDays(6),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Jadili Feedback Collection Event',
                'description' => 'An event focused on collecting feedback from the public about their experiences with government services and USSD interactions.',
                'date' => now()->addDays(8),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
