<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImpactMetricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $metrics = [
            [
                'metric_name' => 'People Served',
                'metric_name_nepali' => 'सेवा प्राप्त व्यक्तिहरू',
                'metric_value' => 1250,
                'metric_unit' => 'individuals',
                'metric_unit_nepali' => 'व्यक्तिहरू',
                'description' => 'Total number of people served across all programs',
                'description_nepali' => 'सबै कार्यक्रमहरूमा सेवा प्राप्त व्यक्तिहरूको कुल संख्या',
                'metric_type' => 'cumulative',
                'is_featured' => true,
                'display_order' => 1,
            ],
            [
                'metric_name' => 'Meals Provided',
                'metric_name_nepali' => 'प्रदान गरिएका खाना',
                'metric_value' => 45000,
                'metric_unit' => 'meals',
                'metric_unit_nepali' => 'खाना',
                'description' => 'Hot meals provided to homeless and elderly individuals',
                'description_nepali' => 'घरबारविहीन र वृद्ध व्यक्तिहरूलाई प्रदान गरिएका तातो खाना',
                'metric_type' => 'cumulative',
                'is_featured' => true,
                'display_order' => 2,
            ],
            [
                'metric_name' => 'Shelter Nights',
                'metric_name_nepali' => 'आश्रय रातहरू',
                'metric_value' => 8500,
                'metric_unit' => 'nights',
                'metric_unit_nepali' => 'रातहरू',
                'description' => 'Safe accommodation nights provided',
                'description_nepali' => 'प्रदान गरिएका सुरक्षित आवास रातहरू',
                'metric_type' => 'cumulative',
                'is_featured' => true,
                'display_order' => 3,
            ],
            [
                'metric_name' => 'Active Volunteers',
                'metric_name_nepali' => 'सक्रिय स्वयंसेवकहरू',
                'metric_value' => 150,
                'metric_unit' => 'volunteers',
                'metric_unit_nepali' => 'स्वयंसेवकहरू',
                'description' => 'Currently active volunteers helping our mission',
                'description_nepali' => 'हाम्रो मिशनमा सहयोग गर्ने हालका सक्रिय स्वयंसेवकहरू',
                'metric_type' => 'current',
                'is_featured' => true,
                'display_order' => 4,
            ],
        ];

        foreach ($metrics as $metric) {
            DB::table('impact_metrics')->insert(array_merge($metric, [
                'recorded_date' => now()->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}