@echo off
echo ========================================
echo   Starting NGO Website Server
echo ========================================
echo.

echo Checking if setup is complete...
if not exist "vendor" (
    echo ERROR: Dependencies not installed
    echo Please run setup.bat first
    pause
    exit /b 1
)

if not exist "database\database.sqlite" (
    echo ERROR: Database not found
    echo Please run setup.bat first
    pause
    exit /b 1
)

echo Starting Laravel development server...
echo.
echo Website will be available at: http://localhost:8000
echo Admin Panel: http://localhost:8000/admin
echo.
echo Login Credentials:
echo Email: admin@buddhabhoomi.org.np
echo Password: password
echo.
echo Press Ctrl+C to stop the server
echo ========================================
echo.

php artisan serve