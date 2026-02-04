<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

describe('Property 12: Admin Authentication Security', function () {
    test('any admin function access attempt requires secure authentication and proper session management', function () {
        // Property: For any admin function access attempt, secure authentication should be required and proper session management should be maintained
        
        $adminRoutes = [
            '/admin',
            '/admin/users',
            '/admin/donations',
            '/admin/volunteers',
            '/admin/blog-posts',
            '/admin/events',
        ];

        foreach ($adminRoutes as $route) {
            // Test unauthenticated access
            $response = $this->get($route);
            expect($response->status())->toBeIn([302, 401, 403]); // Should redirect or deny access
            
            // Test non-admin user access
            $volunteer = User::factory()->create(['role' => 'volunteer']);
            $response = $this->actingAs($volunteer)->get($route);
            expect($response->status())->toBe(403); // Should deny access
            
            // Test inactive admin access
            $inactiveAdmin = User::factory()->create([
                'role' => 'admin',
                'is_active' => false
            ]);
            $response = $this->actingAs($inactiveAdmin)->get($route);
            expect($response->status())->toBeIn([302, 403]); // Should deny access or redirect
            
            // Test active admin access
            $activeAdmin = User::factory()->create([
                'role' => 'admin',
                'is_active' => true
            ]);
            $response = $this->actingAs($activeAdmin)->get($route);
            expect($response->status())->toBeIn([200, 302]); // Should allow access or redirect to valid page
        }
    });

    test('password security policies are enforced', function () {
        // Test password hashing
        $password = 'SecurePassword123!';
        $user = User::factory()->create(['password' => $password]);
        
        expect(Hash::check($password, $user->password))->toBeTrue();
        expect($user->password)->not->toBe($password); // Should be hashed
    });

    test('session management is secure', function () {
        $user = User::factory()->create(['role' => 'admin']);
        
        // Test session creation
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        
        $this->assertAuthenticated();
        
        // Test session invalidation on logout
        $this->post('/logout');
        $this->assertGuest();
    });

    test('role-based access control works correctly', function () {
        $superAdmin = User::factory()->create(['role' => 'super_admin']);
        $admin = User::factory()->create(['role' => 'admin']);
        $volunteer = User::factory()->create(['role' => 'volunteer']);

        expect($superAdmin->isSuperAdmin())->toBeTrue();
        expect($superAdmin->isAdmin())->toBeTrue();
        expect($superAdmin->isVolunteer())->toBeFalse();

        expect($admin->isSuperAdmin())->toBeFalse();
        expect($admin->isAdmin())->toBeTrue();
        expect($admin->isVolunteer())->toBeFalse();

        expect($volunteer->isSuperAdmin())->toBeFalse();
        expect($volunteer->isAdmin())->toBeFalse();
        expect($volunteer->isVolunteer())->toBeTrue();
    });
});