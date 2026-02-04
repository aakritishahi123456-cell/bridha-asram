<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            [
                'name' => 'Surkhet',
                'name_nepali' => 'सुर्खेत',
                'slug' => 'surkhet',
                'description' => 'Our primary operations center, serving as the headquarters for our homeless care and elderly care programs. Surkhet is where we began our mission and continues to be our largest operation.',
                'description_nepali' => 'हाम्रो मुख्य सञ्चालन केन्द्र, हाम्रो घरबारविहीन हेरचाह र वृद्ध हेरचाह कार्यक्रमहरूको मुख्यालयको रूपमा सेवा गर्दै।',
                'coordinator_name' => 'Ram Bahadur Thapa',
                'coordinator_contact' => '+977-83-123456',
                'coordinator_email' => 'surkhet@buddhabhoomi.org.np',
                'address' => 'Birendranagar, Surkhet',
                'address_nepali' => 'वीरेन्द्रनगर, सुर्खेत',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jajarkot',
                'name_nepali' => 'जाजरकोट',
                'slug' => 'jajarkot',
                'description' => 'Our secondary operations, focusing on rural outreach and community-based care programs. Jajarkot represents our commitment to reaching underserved rural communities.',
                'description_nepali' => 'हाम्रो द्वितीयक सञ्चालन, ग्रामीण पहुँच र समुदायमा आधारित हेरचाह कार्यक्रमहरूमा केन्द्रित।',
                'coordinator_name' => 'Sita Kumari Shrestha',
                'coordinator_contact' => '+977-82-654321',
                'coordinator_email' => 'jajarkot@buddhabhoomi.org.np',
                'address' => 'Khalanga, Jajarkot',
                'address_nepali' => 'खलंगा, जाजरकोट',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}