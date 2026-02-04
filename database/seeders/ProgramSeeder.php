<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('programs')->insert([
            [
                'title' => 'Homeless Care Program',
                'title_nepali' => 'घरबारविहीन हेरचाह कार्यक्रम',
                'slug' => 'homeless-care',
                'description' => 'Providing comprehensive support to homeless individuals including shelter, food, clothing, medical care, and rehabilitation programs. Our approach focuses on dignity, respect, and helping people rebuild their lives through job placement assistance and life skills training.',
                'description_nepali' => 'घरबारविहीन व्यक्तिहरूलाई आश्रय, खाना, लुगा, चिकित्सा हेरचाह, र पुनर्वास कार्यक्रमहरू सहित व्यापक सहयोग प्रदान गर्दै।',
                'objectives' => 'Provide immediate shelter and basic needs; Offer medical care and mental health support; Facilitate job placement and skills training; Support long-term rehabilitation and reintegration',
                'objectives_nepali' => 'तत्काल आश्रय र आधारभूत आवश्यकताहरू प्रदान गर्नुहोस्; चिकित्सा हेरचाह र मानसिक स्वास्थ्य सहायता प्रदान गर्नुहोस्',
                'sort_order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Elderly Care Program',
                'title_nepali' => 'वृद्ध हेरचाह कार्यक्रम',
                'slug' => 'elderly-care',
                'description' => 'Caring for elderly citizens who lack family support or adequate resources. We provide medical care, daily assistance, social activities, nutritious meals, and a loving environment where seniors can live with dignity and respect in their golden years.',
                'description_nepali' => 'पारिवारिक सहयोग वा पर्याप्त स्रोतहरूको अभाव भएका वृद्ध नागरिकहरूको हेरचाह गर्दै।',
                'objectives' => 'Provide comprehensive medical care for seniors; Ensure proper nutrition and daily care; Organize social activities and companionship; Maintain dignity and quality of life',
                'objectives_nepali' => 'वृद्धहरूका लागि व्यापक चिकित्सा हेरचाह प्रदान गर्नुहोस्; उचित पोषण र दैनिक हेरचाह सुनिश्चित गर्नुहोस्',
                'sort_order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}