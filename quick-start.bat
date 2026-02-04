@echo off
echo ========================================
echo   NGO Website - Quick Start
echo ========================================
echo.

echo Step 1: Testing PHP installation...
call test-php.bat
if %errorlevel% neq 0 (
    echo Please install PHP first using one of the methods above.
    exit /b 1
)

echo.
echo Step 2: Installing dependencies...
composer install --no-dev --optimize-autoloader
if %errorlevel% neq 0 (
    echo Failed to install Composer dependencies
    pause
    exit /b 1
)

npm install
if %errorlevel% neq 0 (
    echo Failed to install Node dependencies
    pause
    exit /b 1
)

echo.
echo Step 3: Setting up application...
if not exist .env (
    copy .env.example .env
)

php artisan key:generate --force
php artisan migrate --force
php artisan db:seed --force

echo.
echo Step 4: Building assets...
npm run build

echo.
echo ========================================
echo   🎉 Setup Complete!
echo ========================================
echo.
echo Your NGO website is ready!
echo.
echo To start the server:
echo   php artisan serve
echo.
echo Then visit:
echo   Website: http://localhost:8000
echo   Admin: http://localhost:8000/admin
echo.
echo Admin Login:
echo   Email: admin@buddhabhoomi.org.np
echo   Password: password
echo.
echo ========================================
pause