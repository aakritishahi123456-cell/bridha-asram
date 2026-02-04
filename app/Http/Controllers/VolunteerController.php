<?php

namespace App\Http\Controllers;

use App\Http\Requests\VolunteerRequest;
use App\Models\Volunteer;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VolunteerController extends Controller
{
    /**
     * Show the volunteer registration form
     */
    public function create()
    {
        $cities = City::where('is_active', true)->orderBy('name')->get();
        
        return view('volunteer.create', compact('cities'));
    }

    /**
     * Store a new volunteer registration
     */
    public function store(VolunteerRequest $request)
    {
        try {
            $volunteer = Volunteer::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city_id' => $request->city_id,
                'skills' => $request->skills,
                'availability' => $request->availability,
                'motivation' => $request->motivation,
                'age' => $request->age,
                'education' => $request->education,
                'occupation' => $request->occupation,
                'emergency_contact_name' => $request->emergency_contact_name,
                'emergency_contact_phone' => $request->emergency_contact_phone,
                'has_volunteered_before' => $request->boolean('has_volunteered_before'),
                'previous_volunteer_experience' => $request->previous_volunteer_experience,
                'status' => 'pending',
            ]);

            Log::info('Volunteer registration submitted', [
                'volunteer_id' => $volunteer->id,
                'email' => $volunteer->email,
                'city' => $volunteer->city->name
            ]);

            return redirect()->route('volunteer.success')
                ->with('success', 'Thank you for your interest in volunteering! Your application has been submitted and is pending review. We will contact you soon.');

        } catch (\Exception $e) {
            Log::error('Volunteer registration failed', [
                'error' => $e->getMessage(),
                'email' => $request->email
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while submitting your application. Please try again.');
        }
    }

    /**
     * Show volunteer success page
     */
    public function success()
    {
        return view('volunteer.success');
    }

    /**
     * Show volunteer dashboard (for authenticated volunteers)
     */
    public function dashboard()
    {
        $volunteer = auth()->user()->volunteer;
        
        if (!$volunteer) {
            return redirect()->route('volunteer.register')
                ->with('error', 'Please complete your volunteer registration first.');
        }

        return view('volunteer.dashboard', compact('volunteer'));
    }

    /**
     * Show volunteer profile
     */
    public function profile()
    {
        $volunteer = auth()->user()->volunteer;
        
        if (!$volunteer) {
            return redirect()->route('volunteer.register')
                ->with('error', 'Please complete your volunteer registration first.');
        }

        return view('volunteer.profile', compact('volunteer'));
    }

    /**
     * Update volunteer profile
     */
    public function updateProfile(Request $request)
    {
        $volunteer = auth()->user()->volunteer;
        
        if (!$volunteer) {
            return redirect()->route('volunteer.register')
                ->with('error', 'Please complete your volunteer registration first.');
        }

        $request->validate([
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'skills' => 'required|string|max:1000',
            'availability' => 'required|string|max:500',
            'emergency_contact_name' => 'required|string|max:255',
            'emergency_contact_phone' => 'required|string|max:20',
        ]);

        $volunteer->update($request->only([
            'phone', 'address', 'skills', 'availability', 
            'emergency_contact_name', 'emergency_contact_phone'
        ]));

        return redirect()->route('volunteer.profile')
            ->with('success', 'Profile updated successfully.');
    }
}