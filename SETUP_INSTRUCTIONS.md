# NGO Website Local Setup Instructions

## Prerequisites

Before running the application locally, make sure you have the following installed:

1. **PHP 8.2 or higher** with the following extensions:
   - BCMath
   - Ctype
   - Fileinfo
   - JSON
   - Mbstring
   - OpenSSL
   - PDO
   - Tokenizer
   - XML
   - SQLite (for database)

2. **Composer** (PHP dependency manager)
3. **Node.js and npm** (for frontend assets)

## Installation Steps

### 1. Install PHP Dependencies
```bash
composer install
```

### 2. Install Node.js Dependencies
```bash
npm install
```

### 3. Generate Application Key
```bash
php artisan key:generate
```

### 4. Set Up Database
The application is configured to use SQLite for easy local development. The database file is already created at `database/database.sqlite`.

Run the migrations:
```bash
php artisan migrate
```

### 5. Seed the Database
Populate the database with sample data:
```bash
php artisan db:seed
```

This will create:
- Admin user: `admin@buddhabhoomi.org.np` / `password`
- Sample volunteer: `anita.sharma@example.com` / `password`
- Sample cities (Surkhet, Jajarkot)
- Sample programs (Homeless Care, Elderly Care)
- Sample impact metrics
- Sample blog posts and events
- Sample donations

### 6. Build Frontend Assets
```bash
npm run dev
```

For production build:
```bash
npm run build
```

### 7. Start the Development Server
```bash
php artisan serve
```

The application will be available at: `http://localhost:8000`

## Admin Panel Access

The admin panel is available at: `http://localhost:8000/admin`

**Login Credentials:**
- Email: `admin@buddhabhoomi.org.np`
- Password: `password`

## Key Features to Test

### 1. **Homepage** (`/`)
- Hero section with NGO branding
- Animated impact counters
- Mission & vision sections
- Our work programs
- Testimonials
- Latest updates

### 2. **Donation System** (`/donate`)
- Multi-step donation form
- Payment method selection (eSewa, Khalti, Bank Transfer)
- Donation purpose selection
- Security features and FAQ
- **Note:** Payment gateways are in test mode and won't process real payments

### 3. **Volunteer Registration** (`/volunteer`)
- 4-step registration process
- Skills and availability matching
- Emergency contact information
- Terms and conditions acceptance
- Admin approval workflow

### 4. **About Page** (`/about`)
- Organization information
- Mission and vision
- Core values
- Leadership team

### 5. **Admin Panel** (`/admin`)
- **Donations Management:**
  - View all donations
  - Filter by status, purpose, payment method
  - Tabbed interface (All, Pending, Completed, Failed)
  
- **Volunteer Management:**
  - View volunteer applications
  - Approve/reject volunteers
  - Filter by status and city
  - Tabbed interface for different statuses

### 6. **Livewire Components**
- **Impact Counters:** Real-time animated counters with refresh functionality
- **Donation Form:** Interactive form with validation and payment processing
- **Volunteer Form:** Multi-step form with conditional fields

## Testing the Features

### Test Donation Flow:
1. Go to `/donate`
2. Fill out the donation form
3. Select a payment method
4. Submit (will show success message in test mode)
5. Check admin panel to see the donation record

### Test Volunteer Registration:
1. Go to `/volunteer`
2. Complete the 4-step registration process
3. Submit application
4. Login to admin panel to approve the volunteer
5. Check the volunteer status updates

### Test Admin Features:
1. Login to `/admin`
2. Navigate to Donations to see donation management
3. Navigate to Volunteers to see volunteer management
4. Test filtering and bulk actions
5. Approve/reject volunteer applications

## Environment Configuration

The `.env` file is already configured for local development with:
- SQLite database
- Test mode for payment gateways
- Local mail driver (logs emails instead of sending)
- Debug mode enabled

## Troubleshooting

### Common Issues:

1. **"Class not found" errors:**
   ```bash
   composer dump-autoload
   ```

2. **Permission errors:**
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

3. **Database connection errors:**
   - Ensure `database/database.sqlite` exists
   - Check file permissions

4. **Frontend assets not loading:**
   ```bash
   npm run dev
   ```

5. **Livewire component errors:**
   ```bash
   php artisan livewire:publish --config
   ```

## Additional Commands

### Clear caches:
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Run tests:
```bash
php artisan test
```

### Generate new migration:
```bash
php artisan make:migration create_table_name
```

### Create new Livewire component:
```bash
php artisan make:livewire ComponentName
```

## Production Deployment

For production deployment:

1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false`
3. Configure real database (MySQL/PostgreSQL)
4. Set up real payment gateway credentials
5. Configure mail settings
6. Run `php artisan config:cache`
7. Run `php artisan route:cache`
8. Run `php artisan view:cache`

## Support

If you encounter any issues:
1. Check the Laravel logs in `storage/logs/laravel.log`
2. Ensure all dependencies are installed
3. Verify file permissions
4. Check the database connection

The application is built with Laravel 11, Livewire 3, Filament 3, and Tailwind CSS for a modern, responsive, and professional NGO website experience.