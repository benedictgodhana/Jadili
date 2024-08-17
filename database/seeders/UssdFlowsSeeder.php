<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UssdFlowsSeeder extends Seeder
{
    public function run()
    {
        DB::table('ussd_flows')->insert([
            [
                'flow_name' => 'Flow 1',
                'description' => 'Description for Flow 1',
            ],
            [
                'flow_name' => 'Flow 2',
                'description' => 'Description for Flow 2',
            ],
        ]);
    }
}
