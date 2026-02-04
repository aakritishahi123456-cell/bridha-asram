@echo off
echo Testing PHP installation...
echo.

php --version
if %errorlevel% neq 0 (
    echo.
    echo ❌ PHP is not found in PATH
    echo.
    echo QUICK FIX OPTIONS:
    echo.
    echo 1. EASIEST: Install Laravel Herd
    echo    - Go to: https://herd.laravel.com/
    echo    - Download and install
    echo    - Restart terminal
    echo.
    echo 2. XAMPP Method:
    echo    - Install XAMPP from https://www.apachefriends.org/
    echo    - Add C:\xampp\php to your PATH
    echo    - Restart terminal
    echo.
    echo 3. Manual PHP:
    echo    - Download PHP from https://windows.php.net/download/
    echo    - Extract to C:\php
    echo    - Add C:\php to PATH
    echo.
    pause
    exit /b 1
)

echo.
echo ✅ PHP is working!
echo.

composer --version
if %errorlevel% neq 0 (
    echo ❌ Composer not found. Install from: https://getcomposer.org/
    pause
    exit /b 1
)

echo ✅ Composer is working!
echo.

node --version
if %errorlevel% neq 0 (
    echo ❌ Node.js not found. Install from: https://nodejs.org/
    pause
    exit /b 1
)

echo ✅ Node.js is working!
echo.
echo 🎉 All requirements are met! You can now run:
echo    setup.bat
echo.
pause