# Buddhabhoomi Human Service Ashram - NGO Website

A comprehensive Laravel-based website for बुद्धभुमी मानव सेवा आश्रम (Buddhabhoomi Human Service Ashram), a registered non-profit NGO dedicated to homeless care and elderly care services across Nepal.

## Features

- **Public Website**: Professional NGO website with multilingual support (English/Nepali)
- **Donation System**: Secure online donations with eSewa and Khalti integration
- **Volunteer Management**: Registration, approval, and management system for volunteers
- **Admin Dashboard**: Comprehensive Filament-based admin panel for content management
- **Impact Tracking**: Real-time impact metrics and transparency reporting
- **Multi-City Operations**: Support for operations across multiple cities in Nepal
- **Content Management**: Blog, events, gallery, and page management
- **Responsive Design**: Mobile-first design with accessibility features

## Technology Stack

- **Backend**: Laravel 11 LTS
- **Frontend**: Livewire 3.x with Alpine.js
- **Admin Panel**: Filament 3.x
- **Styling**: Tailwind CSS 3.x
- **Database**: MySQL/SQLite
- **Payment Gateways**: eSewa, Khalti
- **Email**: Laravel Mail with queue support

## Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js and npm
- MySQL or SQLite database

### Setup Instructions

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd ngo-website
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure your environment variables in `.env`:**
   - Database connection settings
   - Payment gateway credentials (eSewa, Khalti)
   - Mail configuration
   - NGO-specific settings

6. **Database Setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Build assets**
   ```bash
   npm run build
   ```

8. **Create storage link**
   ```bash
   php artisan storage:link
   ```

9. **Start the development server**
   ```bash
   php artisan serve
   ```

## Configuration

### Payment Gateways

#### eSewa Configuration
```env
ESEWA_MERCHANT_ID=your_merchant_id
ESEWA_SECRET_KEY=your_secret_key
ESEWA_SUCCESS_URL="${APP_URL}/payment/esewa/success"
ESEWA_FAILURE_URL="${APP_URL}/payment/esewa/failure"
```

#### Khalti Configuration
```env
KHALTI_PUBLIC_KEY=your_public_key
KHALTI_SECRET_KEY=your_secret_key
KHALTI_SUCCESS_URL="${APP_URL}/payment/khalti/success"
KHALTI_FAILURE_URL="${APP_URL}/payment/khalti/failure"
```

### NGO Settings
```env
NGO_NAME="बुद्धभुमी मानव सेवा आश्रम"
NGO_NAME_ENGLISH="Buddhabhoomi Human Service Ashram"
NGO_REGISTRATION_NUMBER="12345/2080"
NGO_EMAIL="info@buddhabhoomi.org.np"
NGO_PHONE="+977-83-123456"
NGO_ADDRESS="Surkhet, Nepal"
```

## Usage

### Admin Panel

Access the admin panel at `/admin` with the following default credentials:
- Email: admin@buddhabhoomi.org.np
- Password: password

### Key Features

1. **Content Management**: Create and manage blog posts, events, and pages
2. **Volunteer Management**: Review and approve volunteer applications
3. **Donation Tracking**: Monitor donations and generate reports
4. **Impact Metrics**: Update and track organizational impact
5. **User Management**: Manage user accounts and roles

### Public Website

The public website includes:
- Homepage with impact counters and program information
- About Us and organizational information
- Program details (Homeless Care, Elderly Care)
- City-specific pages (Surkhet, Jajarkot)
- Blog and events
- Donation and volunteer registration forms
- Contact information

## Development

### Running Tests

```bash
php artisan test
```

### Code Style

```bash
./vendor/bin/pint
```

### Asset Development

```bash
# Development
npm run dev

# Production build
npm run build
```

## Security

- CSRF protection on all forms
- Input validation and sanitization
- Secure password policies
- Role-based access control
- Audit logging for admin actions
- Secure payment processing

## Multilingual Support

The website supports both English and Nepali languages:
- Language switcher in navigation
- Content translation management in admin panel
- Proper Unicode rendering for Nepali text
- Localized date and number formatting

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run tests and ensure code quality
5. Submit a pull request

## License

This project is licensed under the MIT License.

## Support

For support and questions, please contact:
- Email: info@buddhabhoomi.org.np
- Phone: +977-83-123456

## Acknowledgments

- Laravel Framework
- Filament Admin Panel
- Tailwind CSS
- Alpine.js
- Livewire
- All contributors and volunteers

---

**Buddhabhoomi Human Service Ashram** - Dedicated to providing compassionate care and support to those in need across Nepal.