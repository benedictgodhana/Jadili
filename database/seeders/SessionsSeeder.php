<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SessionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sessions')->insert([
            [
                'user_id' => 1,
                'session_id' => 'session_001',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'session_id' => 'session_002',
                'created_at' => now()->addHours(1),
                'updated_at' => now()->addHours(1),
            ],
            [
                'user_id' => 3,
                'session_id' => 'session_003',
                'created_at' => now()->addHours(2),
                'updated_at' => now()->addHours(2),
            ],
            [
                'user_id' => 1,
                'session_id' => 'session_004',
                'created_at' => now()->addDays(1),
                'updated_at' => now()->addDays(1),
            ],
            [
                'user_id' => 4,
                'session_id' => 'session_005',
                'created_at' => now()->addDays(2),
                'updated_at' => now()->addDays(2),
            ],
        ]);
    }
}
