<?php

namespace Tests\Feature;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\City;
use App\Models\Donation;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\ImpactMetric;
use App\Models\MediaFile;
use App\Models\Program;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DatabaseModelsTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_model_relationships()
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        // Test volunteer relationship
        $volunteer = Volunteer::factory()->create(['user_id' => $user->id]);
        $this->assertTrue($user->volunteer->is($volunteer));

        // Test blog posts relationship
        $blogPost = BlogPost::factory()->create(['author_id' => $user->id]);
        $this->assertTrue($user->blogPosts->contains($blogPost));

        // Test events relationship
        $event = Event::factory()->create(['created_by' => $user->id]);
        $this->assertTrue($user->events->contains($event));
    }

    public function test_city_model_relationships()
    {
        $city = City::factory()->create();

        // Test volunteers relationship
        $volunteer = Volunteer::factory()->create(['city_id' => $city->id]);
        $this->assertTrue($city->volunteers->contains($volunteer));

        // Test events relationship
        $event = Event::factory()->create(['city_id' => $city->id]);
        $this->assertTrue($city->events->contains($event));

        // Test blog posts relationship
        $blogPost = BlogPost::factory()->create(['city_id' => $city->id]);
        $this->assertTrue($city->blogPosts->contains($blogPost));
    }

    public function test_program_model_relationships()
    {
        $program = Program::factory()->create();

        // Test events relationship
        $event = Event::factory()->create(['program_id' => $program->id]);
        $this->assertTrue($program->events->contains($event));

        // Test impact metrics relationship
        $metric = ImpactMetric::factory()->create(['program_id' => $program->id]);
        $this->assertTrue($program->impactMetrics->contains($metric));
    }

    public function test_blog_post_categories_relationship()
    {
        $blogPost = BlogPost::factory()->create();
        $category = BlogCategory::factory()->create();

        $blogPost->categories()->attach($category);

        $this->assertTrue($blogPost->categories->contains($category));
        $this->assertTrue($category->blogPosts->contains($blogPost));
    }

    public function test_event_registrations_relationship()
    {
        $event = Event::factory()->create();
        $registration = EventRegistration::factory()->create(['event_id' => $event->id]);

        $this->assertTrue($event->registrations->contains($registration));
        $this->assertTrue($registration->event->is($event));
    }

    public function test_donation_model_attributes()
    {
        $donation = Donation::factory()->create([
            'amount' => 1500.50,
            'currency' => 'NPR',
            'purpose' => 'homeless_care',
            'payment_method' => 'esewa',
            'payment_status' => 'completed',
        ]);

        $this->assertEquals('NPR 1,500.50', $donation->formatted_amount);
        $this->assertEquals('Homeless Care', $donation->purpose_display);
        $this->assertEquals('eSewa', $donation->payment_method_display);
        $this->assertEquals('Completed', $donation->status_display);
        $this->assertTrue($donation->isCompleted());
    }

    public function test_volunteer_model_attributes()
    {
        $volunteer = Volunteer::factory()->create([
            'status' => 'pending',
            'date_of_birth' => now()->subYears(25),
        ]);

        $this->assertEquals('Pending Approval', $volunteer->status_display);
        $this->assertEquals(25, $volunteer->age);
        $this->assertTrue($volunteer->isPending());
        $this->assertFalse($volunteer->isApproved());
    }

    public function test_impact_metric_model_attributes()
    {
        $metric = ImpactMetric::factory()->create([
            'metric_name' => 'People Served',
            'metric_value' => 1250,
            'metric_unit' => 'individuals',
            'metric_type' => 'cumulative',
        ]);

        $this->assertEquals('1,250 individuals', $metric->formatted_value);
        $this->assertEquals('Cumulative', $metric->type_display);
    }

    public function test_event_model_attributes()
    {
        $event = Event::factory()->create([
            'start_date' => now()->addDays(7),
            'max_participants' => 50,
            'current_participants' => 30,
            'requires_registration' => true,
        ]);

        $this->assertEquals(20, $event->available_spots);
        $this->assertFalse($event->isFull());
        $this->assertTrue($event->isRegistrationOpen());
        $this->assertTrue($event->isUpcoming());
    }

    public function test_media_file_model_attributes()
    {
        $mediaFile = MediaFile::factory()->create([
            'file_size' => 1048576, // 1MB
            'media_type' => 'image',
            'width' => 1920,
            'height' => 1080,
        ]);

        $this->assertEquals('1 MB', $mediaFile->formatted_size);
        $this->assertEquals('1920 × 1080', $mediaFile->dimensions);
        $this->assertTrue($mediaFile->isImage());
        $this->assertFalse($mediaFile->isVideo());
    }

    public function test_model_scopes()
    {
        // Test City active scope
        City::factory()->create(['is_active' => true]);
        City::factory()->create(['is_active' => false]);
        $this->assertEquals(1, City::active()->count());

        // Test Program active scope
        Program::factory()->create(['is_active' => true]);
        Program::factory()->create(['is_active' => false]);
        $this->assertEquals(1, Program::active()->count());

        // Test Volunteer pending scope
        Volunteer::factory()->create(['status' => 'pending']);
        Volunteer::factory()->create(['status' => 'approved']);
        $this->assertEquals(1, Volunteer::pending()->count());

        // Test Donation completed scope
        Donation::factory()->completed()->create();
        Donation::factory()->pending()->create();
        $this->assertEquals(1, Donation::completed()->count());
    }

    public function test_multilingual_attributes()
    {
        $city = City::factory()->create([
            'name' => 'Kathmandu',
            'name_nepali' => 'काठमाडौं',
            'description' => 'Capital city',
            'description_nepali' => 'राजधानी शहर',
        ]);

        // Test fallback to English when Nepali is not set
        $this->assertEquals('काठमाडौं', $city->display_name);
        $this->assertEquals('राजधानी शहर', $city->display_description);

        // Test fallback when Nepali is null
        $city->update(['name_nepali' => null, 'description_nepali' => null]);
        $this->assertEquals('Kathmandu', $city->display_name);
        $this->assertEquals('Capital city', $city->display_description);
    }
}