<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UssdResponsesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ussd_responses')->insert([
            [
                'user_id' => 1,
                'ussd_flow_step_id' => 1,
                'response' => 'Yes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'ussd_flow_step_id' => 2,
                'response' => 'No',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'ussd_flow_step_id' => 1,
                'response' => 'Interested',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'ussd_flow_step_id' => 3,
                'response' => 'Not Interested',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'ussd_flow_step_id' => 2,
                'response' => 'Yes',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'ussd_flow_step_id' => 3,
                'response' => 'No',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'ussd_flow_step_id' => 1,
                'response' => 'Approved',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 4,
                'ussd_flow_step_id' => 2,
                'response' => 'Rejected',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
