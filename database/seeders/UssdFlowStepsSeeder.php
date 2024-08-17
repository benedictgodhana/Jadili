<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UssdFlowStepsSeeder extends Seeder
{
    public function run()
    {
        DB::table('ussd_flow_steps')->insert([
            // Example flow for public engagement
            [
                'ussd_flow_id' => 1,
                'step_number' => 1,
                'message' => 'Welcome to the Public Engagement System. Press 1 to provide feedback, 2 to report an issue, 3 to participate in the forum.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ussd_flow_id' => 1,
                'step_number' => 2,
                'message' => 'You selected Feedback. Please enter your feedback on the current issue.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ussd_flow_id' => 1,
                'step_number' => 3,
                'message' => 'Thank you for your feedback. Press 1 to return to the main menu, 2 to exit.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Example flow for reporting a public issue
            [
                'ussd_flow_id' => 2,
                'step_number' => 1,
                'message' => 'Welcome to the Issue Reporting System. Press 1 to report an issue, 2 to return to the main menu.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ussd_flow_id' => 2,
                'step_number' => 2,
                'message' => 'Please provide details about the issue you are reporting.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'ussd_flow_id' => 2,
                'step_number' => 3,
                'message' => 'Thank you for reporting the issue. Press 1 to return to the main menu, 2 to exit.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Example flow for public forum participation
           
        ]);
    }
}
