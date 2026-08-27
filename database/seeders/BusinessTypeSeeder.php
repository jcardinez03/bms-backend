<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BusinessType;
class BusinessTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $business_type = new BusinessType;
        $business_types =[
            [
                'name' => 'Service'
            ],
            [
                'name' => 'Retail'
            ],
            [
                'name' => 'Wholesale'
            ],
            [
                'name' => 'E-commerce'
            ],
            [
                'name' => 'Manufacturing'
            ],
            [
                'name' => 'Others'
            ]
        ];

        $business_type->insert($business_types);
    }
}
