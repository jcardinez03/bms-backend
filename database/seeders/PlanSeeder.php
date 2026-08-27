<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Plan;
class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plan = new Plan;
        $plans =[
            [
                'name' => 'Starter',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Pro',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Enterprise',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        $plan->insert($plans);
    }
}
