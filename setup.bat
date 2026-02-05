@echo off
echo ========================================
echo   NGO Website Setup Script
echo ========================================
echo.

echo Checking PHP installation...
php --version
if %errorlevel% neq 0 (
    echo ERROR: PHP is not found in PATH
    echo.
    echo Please add PHP to your PATH:
    echo 1. If you installed XAMPP: Add C:\xampp\php to PATH
    echo 2. If you installed Laravel Herd: It should be automatic
    echo 3. Restart your terminal after adding to PATH
    echo.
    pause
    exit /b 1
)

echo.
echo PHP found! Continuing with setup...
echo.

echo Step 1: Installing Composer dependencies...
composer install
if %errorlevel% neq 0 (
    echo ERROR: Composer install failed
    echo Make sure Composer is installed: https://getcomposer.org/
    pause
    exit /b 1
)

echo.
echo Step 2: Installing Node.js dependencies...
npm install
if %errorlevel% neq 0 (
    echo ERROR: npm install failed
    echo Make sure Node.js is installed: https://nodejs.org/
    pause
    exit /b 1
)

echo.
echo Step 3: Generating application key...
php artisan key:generate

echo.
echo Step 4: Running database migrations...
php artisan migrate --force

echo.
echo Step 5: Seeding database with sample data...
php artisan db:seed --force

echo.
echo Step 6: Building frontend assets...
npm run build

echo.
echo ========================================
echo   Setup Complete!
echo ========================================
echo.
echo Your NGO website is ready to run!
echo.
echo To start the development server:
echo   php artisan serve
echo.
echo Then visit: http://localhost:8000
echo.
echo Admin Panel: http://localhost:8000/admin
echo Login: admin@buddhabhoomi.org.np
echo Password: password
echo.
echo ========================================
pause