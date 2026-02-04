<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        try {
            // In a real application, you would send an email here
            // Mail::to(env('NGO_EMAIL'))->send(new ContactFormMail($request->all()));
            
            Log::info('Contact form submission', [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
            ]);

            return redirect()->back()
                ->with('success', 'Thank you for your message! We will get back to you soon.');

        } catch (\Exception $e) {
            Log::error('Contact form submission failed', [
                'error' => $e->getMessage(),
                'email' => $request->email
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while sending your message. Please try again.');
        }
    }
}