<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\City;
use App\Models\Program;
use App\Models\ImpactMetric;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Event;
use App\Models\Volunteer;
use App\Models\Donation;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@buddhabhoomi.org.np',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create cities
        $surkhet = City::create([
            'name' => 'Surkhet',
            'name_nepali' => 'सुर्खेत',
            'slug' => 'surkhet',
            'description' => 'Our primary location providing comprehensive care services.',
            'coordinator_name' => 'Ram Bahadur Sharma',
            'coordinator_contact' => '+977-83-520123',
            'is_active' => true,
        ]);

        $jajarkot = City::create([
            'name' => 'Jajarkot',
            'name_nepali' => 'जाजरकोट',
            'slug' => 'jajarkot',
            'description' => 'Our secondary location expanding our reach to rural communities.',
            'coordinator_name' => 'Sita Kumari Thapa',
            'coordinator_contact' => '+977-83-520124',
            'is_active' => true,
        ]);

        // Create programs
        $homelessCare = Program::create([
            'title' => 'Homeless Care Program',
            'title_nepali' => 'घरबारविहीन हेरचाह कार्यक्रम',
            'slug' => 'homeless-care',
            'description' => 'Comprehensive care and rehabilitation services for homeless individuals including shelter, meals, healthcare, and job training.',
            'description_nepali' => 'घरबारविहीन व्यक्तिहरूका लागि आश्रय, खाना, स्वास्थ्य सेवा र रोजगारी तालिम सहितको व्यापक हेरचाह र पुनर्वास सेवा।',
            'is_active' => true,
        ]);

        $elderlyCare = Program::create([
            'title' => 'Elderly Care Program',
            'title_nepali' => 'वृद्ध हेरचाह कार्यक्रम',
            'slug' => 'elderly-care',
            'description' => '24/7 care and support for elderly individuals including medical care, social activities, and companionship.',
            'description_nepali' => 'वृद्धवृद्धाहरूका लागि चिकित्सा सेवा, सामाजिक गतिविधि र साथीभाव सहितको २४/७ हेरचाह र सहयोग।',
            'is_active' => true,
        ]);

        // Create impact metrics
        ImpactMetric::create([
            'metric_name' => 'people_sheltered',
            'metric_value' => 150,
            'metric_unit' => 'people',
            'city_id' => $surkhet->id,
            'program_id' => $homelessCare->id,
            'recorded_date' => now()->subDays(30),
        ]);

        ImpactMetric::create([
            'metric_name' => 'elderly_cared',
            'metric_value' => 85,
            'metric_unit' => 'people',
            'city_id' => $surkhet->id,
            'program_id' => $elderlyCare->id,
            'recorded_date' => now()->subDays(30),
        ]);

        ImpactMetric::create([
            'metric_name' => 'meals_served',
            'metric_value' => 12500,
            'metric_unit' => 'meals',
            'city_id' => $surkhet->id,
            'recorded_date' => now()->subDays(30),
        ]);

        ImpactMetric::create([
            'metric_name' => 'people_sheltered',
            'metric_value' => 45,
            'metric_unit' => 'people',
            'city_id' => $jajarkot->id,
            'program_id' => $homelessCare->id,
            'recorded_date' => now()->subDays(30),
        ]);

        ImpactMetric::create([
            'metric_name' => 'elderly_cared',
            'metric_value' => 32,
            'metric_unit' => 'people',
            'city_id' => $jajarkot->id,
            'program_id' => $elderlyCare->id,
            'recorded_date' => now()->subDays(30),
        ]);

        ImpactMetric::create([
            'metric_name' => 'meals_served',
            'metric_value' => 4200,
            'metric_unit' => 'meals',
            'city_id' => $jajarkot->id,
            'recorded_date' => now()->subDays(30),
        ]);

        // Create blog categories
        $newsCategory = BlogCategory::create([
            'name' => 'News & Updates',
            'name_nepali' => 'समाचार र अपडेट',
            'slug' => 'news-updates',
            'description' => 'Latest news and updates from our organization',
        ]);

        $storiesCategory = BlogCategory::create([
            'name' => 'Success Stories',
            'name_nepali' => 'सफलताका कथाहरू',
            'slug' => 'success-stories',
            'description' => 'Inspiring stories from our beneficiaries and volunteers',
        ]);

        // Create sample blog posts
        BlogPost::create([
            'title' => 'New Shelter Facility Opens in Surkhet',
            'title_nepali' => 'सुर्खेतमा नयाँ आश्रय सुविधा खोलियो',
            'slug' => 'new-shelter-facility-opens-surkhet',
            'excerpt' => 'We are excited to announce the opening of our new 50-bed shelter facility in Surkhet, expanding our capacity to serve more homeless individuals.',
            'content' => 'We are thrilled to announce the grand opening of our new shelter facility in Surkhet, which will significantly expand our capacity to serve homeless individuals in the region. This state-of-the-art facility features 50 beds, modern amenities, and dedicated spaces for rehabilitation programs.',
            'category_id' => $newsCategory->id,
            'author_id' => $admin->id,
            'status' => 'published',
            'published_at' => now()->subDays(5),
        ]);

        BlogPost::create([
            'title' => 'From Homelessness to Hope: Raj\'s Journey',
            'title_nepali' => 'घरबारविहीनताबाट आशामा: राजको यात्रा',
            'slug' => 'from-homelessness-to-hope-raj-journey',
            'excerpt' => 'Meet Raj, a former beneficiary who has transformed his life through our programs and is now helping others in similar situations.',
            'content' => 'Raj came to us two years ago, struggling with homelessness and addiction. Through our comprehensive care program, he received shelter, counseling, job training, and most importantly, hope. Today, Raj works as a peer counselor, helping other individuals on their journey to recovery.',
            'category_id' => $storiesCategory->id,
            'author_id' => $admin->id,
            'status' => 'published',
            'published_at' => now()->subDays(10),
        ]);

        // Create sample events
        Event::create([
            'title' => 'Community Outreach Program',
            'title_nepali' => 'सामुदायिक पहुँच कार्यक्रम',
            'slug' => 'community-outreach-program-march-2024',
            'description' => 'Join us for our monthly community outreach program where we provide free health checkups and meals to the homeless community.',
            'event_date' => now()->addDays(15),
            'event_time' => '10:00:00',
            'location' => 'Surkhet City Center',
            'city_id' => $surkhet->id,
            'max_participants' => 100,
            'registration_required' => true,
            'status' => 'published',
            'created_by' => $admin->id,
        ]);

        Event::create([
            'title' => 'Volunteer Training Workshop',
            'title_nepali' => 'स्वयंसेवक तालिम कार्यशाला',
            'slug' => 'volunteer-training-workshop-march-2024',
            'description' => 'Comprehensive training workshop for new volunteers covering our programs, policies, and best practices for working with vulnerable populations.',
            'event_date' => now()->addDays(8),
            'event_time' => '09:00:00',
            'location' => 'Buddhabhoomi Training Center, Surkhet',
            'city_id' => $surkhet->id,
            'max_participants' => 25,
            'registration_required' => true,
            'status' => 'published',
            'created_by' => $admin->id,
        ]);

        // Create sample volunteers
        $volunteer1 = User::create([
            'name' => 'Anita Sharma',
            'email' => 'anita.sharma@example.com',
            'password' => Hash::make('password'),
            'role' => 'volunteer',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        Volunteer::create([
            'user_id' => $volunteer1->id,
            'city_id' => $surkhet->id,
            'full_name' => 'Anita Sharma',
            'email' => 'anita.sharma@example.com',
            'phone' => '+977-9841234567',
            'address' => 'Birendranagar, Surkhet',
            'skills' => 'Nursing, First Aid, Patient Care',
            'availability' => 'Weekends and evenings',
            'motivation' => 'I want to give back to my community and help those in need.',
            'age' => 28,
            'education' => 'Bachelor in Nursing',
            'occupation' => 'Registered Nurse',
            'emergency_contact_name' => 'Ramesh Sharma',
            'emergency_contact_phone' => '+977-9841234568',
            'status' => 'approved',
            'approved_by' => $admin->id,
            'approved_at' => now()->subDays(20),
        ]);

        $volunteer2 = User::create([
            'name' => 'Bikash Thapa',
            'email' => 'bikash.thapa@example.com',
            'password' => Hash::make('password'),
            'role' => 'volunteer',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        Volunteer::create([
            'user_id' => $volunteer2->id,
            'city_id' => $jajarkot->id,
            'full_name' => 'Bikash Thapa',
            'email' => 'bikash.thapa@example.com',
            'phone' => '+977-9851234567',
            'address' => 'Khalanga, Jajarkot',
            'skills' => 'Teaching, Computer Skills, Administrative Work',
            'availability' => 'Flexible schedule',
            'motivation' => 'Education is the key to breaking the cycle of poverty.',
            'age' => 32,
            'education' => 'Master in Education',
            'occupation' => 'School Teacher',
            'emergency_contact_name' => 'Maya Thapa',
            'emergency_contact_phone' => '+977-9851234568',
            'status' => 'approved',
            'approved_by' => $admin->id,
            'approved_at' => now()->subDays(15),
        ]);

        // Create sample donations
        Donation::create([
            'donor_name' => 'Rajesh Poudel',
            'donor_email' => 'rajesh.poudel@example.com',
            'donor_phone' => '+977-9841111111',
            'amount' => 5000.00,
            'currency' => 'NPR',
            'purpose' => 'homeless_care',
            'payment_method' => 'esewa',
            'transaction_id' => 'ESW-' . time() . '-001',
            'payment_status' => 'completed',
            'receipt_number' => 'NGO-000001-2024',
            'notes' => 'Keep up the great work!',
        ]);

        Donation::create([
            'donor_name' => 'Sunita Adhikari',
            'donor_email' => 'sunita.adhikari@example.com',
            'donor_phone' => '+977-9842222222',
            'amount' => 2500.00,
            'currency' => 'NPR',
            'purpose' => 'elderly_care',
            'payment_method' => 'khalti',
            'transaction_id' => 'KHL-' . time() . '-002',
            'payment_status' => 'completed',
            'receipt_number' => 'NGO-000002-2024',
        ]);

        Donation::create([
            'donor_name' => 'Anonymous',
            'donor_email' => 'donor@example.com',
            'amount' => 10000.00,
            'currency' => 'NPR',
            'purpose' => 'general_fund',
            'payment_method' => 'bank_transfer',
            'transaction_id' => 'BANK-' . time() . '-003',
            'payment_status' => 'completed',
            'receipt_number' => 'NGO-000003-2024',
            'notes' => 'Anonymous donation for general operations',
        ]);

        echo "Database seeded successfully!\n";
        echo "Admin login: admin@buddhabhoomi.org.np / password\n";
        echo "Volunteer login: anita.sharma@example.com / password\n";
    }
}