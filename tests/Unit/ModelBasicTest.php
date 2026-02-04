<?php

namespace Tests\Unit;

use App\Models\City;
use App\Models\Donation;
use App\Models\Program;
use App\Models\User;
use App\Models\Volunteer;
use PHPUnit\Framework\TestCase;

class ModelBasicTest extends TestCase
{
    public function test_user_model_has_correct_fillable_attributes()
    {
        $user = new User();
        $expected = [
            'name',
            'email',
            'password',
            'role',
            'is_active',
        ];
        
        $this->assertEquals($expected, $user->getFillable());
    }

    public function test_user_model_has_correct_hidden_attributes()
    {
        $user = new User();
        $expected = [
            'password',
            'remember_token',
        ];
        
        $this->assertEquals($expected, $user->getHidden());
    }

    public function test_city_model_has_correct_fillable_attributes()
    {
        $city = new City();
        $expected = [
            'name',
            'name_nepali',
            'slug',
            'description',
            'description_nepali',
            'coordinator_name',
            'coordinator_contact',
            'coordinator_email',
            'address',
            'address_nepali',
            'image_path',
            'is_active',
        ];
        
        $this->assertEquals($expected, $city->getFillable());
    }

    public function test_program_model_has_correct_fillable_attributes()
    {
        $program = new Program();
        $expected = [
            'title',
            'title_nepali',
            'slug',
            'description',
            'description_nepali',
            'objectives',
            'objectives_nepali',
            'image_path',
            'gallery_images',
            'sort_order',
            'is_active',
        ];
        
        $this->assertEquals($expected, $program->getFillable());
    }

    public function test_donation_model_has_correct_fillable_attributes()
    {
        $donation = new Donation();
        $expected = [
            'donor_name',
            'donor_email',
            'donor_phone',
            'donor_address',
            'amount',
            'currency',
            'purpose',
            'payment_method',
            'transaction_id',
            'payment_reference',
            'payment_status',
            'receipt_number',
            'notes',
            'admin_notes',
            'payment_details',
            'payment_completed_at',
            'processed_by',
        ];
        
        $this->assertEquals($expected, $donation->getFillable());
    }

    public function test_volunteer_model_has_correct_fillable_attributes()
    {
        $volunteer = new Volunteer();
        $expected = [
            'user_id',
            'city_id',
            'full_name',
            'email',
            'phone',
            'date_of_birth',
            'gender',
            'address',
            'address_nepali',
            'occupation',
            'education',
            'skills',
            'availability',
            'motivation',
            'experience',
            'preferred_programs',
            'emergency_contact_name',
            'emergency_contact_phone',
            'status',
            'rejection_reason',
            'approved_by',
            'approved_at',
            'last_activity_at',
        ];
        
        $this->assertEquals($expected, $volunteer->getFillable());
    }

    public function test_user_role_methods()
    {
        $user = new User();
        
        // Test super admin
        $user->role = 'super_admin';
        $this->assertTrue($user->isSuperAdmin());
        $this->assertTrue($user->isAdmin());
        $this->assertFalse($user->isVolunteer());
        
        // Test admin
        $user->role = 'admin';
        $this->assertFalse($user->isSuperAdmin());
        $this->assertTrue($user->isAdmin());
        $this->assertFalse($user->isVolunteer());
        
        // Test volunteer
        $user->role = 'volunteer';
        $this->assertFalse($user->isSuperAdmin());
        $this->assertFalse($user->isAdmin());
        $this->assertTrue($user->isVolunteer());
    }

    public function test_donation_status_methods()
    {
        $donation = new Donation();
        
        // Test completed status
        $donation->payment_status = 'completed';
        $this->assertTrue($donation->isCompleted());
        $this->assertFalse($donation->isPending());
        
        // Test pending status
        $donation->payment_status = 'pending';
        $this->assertFalse($donation->isCompleted());
        $this->assertTrue($donation->isPending());
    }

    public function test_volunteer_status_methods()
    {
        $volunteer = new Volunteer();
        
        // Test pending status
        $volunteer->status = 'pending';
        $this->assertTrue($volunteer->isPending());
        $this->assertFalse($volunteer->isApproved());
        $this->assertFalse($volunteer->isRejected());
        
        // Test approved status
        $volunteer->status = 'approved';
        $this->assertFalse($volunteer->isPending());
        $this->assertTrue($volunteer->isApproved());
        $this->assertFalse($volunteer->isRejected());
        
        // Test rejected status
        $volunteer->status = 'rejected';
        $this->assertFalse($volunteer->isPending());
        $this->assertFalse($volunteer->isApproved());
        $this->assertTrue($volunteer->isRejected());
    }
}