<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Language switching
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ne'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');

// Programs
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{program:slug}', [ProgramController::class, 'show'])->name('programs.show');

// Cities
Route::get('/cities', [CityController::class, 'index'])->name('cities.index');
Route::get('/cities/{city:slug}', [CityController::class, 'show'])->name('cities.show');

// Blog
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

// Events
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');

// Donations
Route::get('/donate', [DonationController::class, 'create'])->name('donate');
Route::post('/donate', [DonationController::class, 'store'])->name('donate.store');
Route::get('/donate/success', [DonationController::class, 'success'])->name('donate.success');
Route::get('/donate/cancel', [DonationController::class, 'cancel'])->name('donate.cancel');

// Volunteer Registration
Route::get('/volunteer', [VolunteerController::class, 'create'])->name('volunteer.register');
Route::post('/volunteer', [VolunteerController::class, 'store'])->name('volunteer.store');
Route::get('/volunteer/success', [VolunteerController::class, 'success'])->name('volunteer.success');

// Payment Gateway Callbacks
Route::prefix('payment')->name('payment.')->group(function () {
    Route::post('/esewa/callback', [PaymentController::class, 'esewaCallback'])->name('esewa.callback');
    Route::get('/esewa/success', [PaymentController::class, 'esewaSuccess'])->name('esewa.success');
    Route::get('/esewa/failure', [PaymentController::class, 'esewaFailure'])->name('esewa.failure');
    
    Route::post('/khalti/callback', [PaymentController::class, 'khaltiCallback'])->name('khalti.callback');
    Route::get('/khalti/success', [PaymentController::class, 'khaltiSuccess'])->name('khalti.success');
    Route::get('/khalti/failure', [PaymentController::class, 'khaltiFailure'])->name('khalti.failure');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    
    // Volunteer Dashboard
    Route::middleware('volunteer')->prefix('volunteer')->name('volunteer.')->group(function () {
        Route::get('/dashboard', [VolunteerController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [VolunteerController::class, 'profile'])->name('profile');
        Route::put('/profile', [VolunteerController::class, 'updateProfile'])->name('profile.update');
    });
});

// Admin Routes (handled by Filament)
// These will be automatically registered by Filament at /admin