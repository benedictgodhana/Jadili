<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationalMaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('educational_materials')->insert([
            [
                'title' => 'Introduction to USSD',
                'description' => 'A beginner’s guide to understanding and using USSD technology.',
                'file_path' => 'path/to/introduction-to-ussd.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Advanced USSD Techniques',
                'description' => 'Detailed techniques and strategies for advanced USSD implementations.',
                'file_path' => 'path/to/advanced-ussd-techniques.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'USSD Flow Management',
                'description' => 'Managing and optimizing USSD flow for better user experience.',
                'file_path' => 'path/to/ussd-flow-management.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Public Engagement Strategies',
                'description' => 'Strategies for engaging the public effectively through USSD.',
                'file_path' => 'path/to/public-engagement-strategies.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Data Collection with USSD',
                'description' => 'Methods and best practices for collecting data using USSD.',
                'file_path' => 'path/to/data-collection-with-ussd.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
