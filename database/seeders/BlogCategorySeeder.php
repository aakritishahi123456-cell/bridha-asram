<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'News & Updates',
                'name_nepali' => 'समाचार र अपडेटहरू',
                'slug' => 'news-updates',
                'description' => 'Latest news and updates about our organization and activities',
                'description_nepali' => 'हाम्रो संस्था र गतिविधिहरूको बारेमा नवीनतम समाचार र अपडेटहरू',
                'color' => '#3B82F6',
                'icon' => 'newspaper',
                'sort_order' => 1,
            ],
            [
                'name' => 'Success Stories',
                'name_nepali' => 'सफलताका कथाहरू',
                'slug' => 'success-stories',
                'description' => 'Inspiring stories of people whose lives we have touched',
                'description_nepali' => 'हामीले छुन्यौं जीवनका मानिसहरूका प्रेरणादायक कथाहरू',
                'color' => '#10B981',
                'icon' => 'heart',
                'sort_order' => 2,
            ],
            [
                'name' => 'Community Events',
                'name_nepali' => 'सामुदायिक कार्यक्रमहरू',
                'slug' => 'community-events',
                'description' => 'Information about upcoming and past community events',
                'description_nepali' => 'आगामी र विगतका सामुदायिक कार्यक्रमहरूको जानकारी',
                'color' => '#F59E0B',
                'icon' => 'calendar',
                'sort_order' => 3,
            ],
            [
                'name' => 'Volunteer Spotlight',
                'name_nepali' => 'स्वयंसेवक स्पटलाइट',
                'slug' => 'volunteer-spotlight',
                'description' => 'Highlighting the amazing work of our volunteers',
                'description_nepali' => 'हाम्रा स्वयंसेवकहरूको अद्भुत कामलाई उजागर गर्दै',
                'color' => '#8B5CF6',
                'icon' => 'users',
                'sort_order' => 4,
            ],
            [
                'name' => 'Health & Wellness',
                'name_nepali' => 'स्वास्थ्य र कल्याण',
                'slug' => 'health-wellness',
                'description' => 'Health tips and wellness information for our community',
                'description_nepali' => 'हाम्रो समुदायका लागि स्वास्थ्य सुझावहरू र कल्याण जानकारी',
                'color' => '#EF4444',
                'icon' => 'heart-pulse',
                'sort_order' => 5,
            ],
            [
                'name' => 'Fundraising',
                'name_nepali' => 'कोष संकलन',
                'slug' => 'fundraising',
                'description' => 'Information about fundraising campaigns and donation drives',
                'description_nepali' => 'कोष संकलन अभियान र दान अभियानहरूको जानकारी',
                'color' => '#06B6D4',
                'icon' => 'hand-heart',
                'sort_order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            DB::table('blog_categories')->insert(array_merge($category, [
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}