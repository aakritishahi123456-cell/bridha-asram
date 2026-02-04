@echo off
echo ========================================
echo   GitHub Repository Setup
echo ========================================
echo.

echo This script will help you create a GitHub repository
echo for your NGO website and prepare it for deployment.
echo.

echo Step 1: Initialize Git repository...
git init
if %errorlevel% neq 0 (
    echo Error: Git is not installed or not in PATH
    echo Please install Git from: https://git-scm.com/
    pause
    exit /b 1
)

echo.
echo Step 2: Add all files to Git...
git add .

echo.
echo Step 3: Create initial commit...
git commit -m "Initial commit: Buddhabhoomi NGO website ready for deployment"

echo.
echo Step 4: Set main branch...
git branch -M main

echo.
echo ========================================
echo   NEXT STEPS:
echo ========================================
echo.
echo 1. Go to GitHub.com and create a new repository
echo    Repository name: buddhabhoomi-ngo
echo    Description: Professional NGO website for Buddhabhoomi Human Service Ashram
echo    Make it Public (for free hosting)
echo.
echo 2. Copy the repository URL (it will look like):
echo    https://github.com/yourusername/buddhabhoomi-ngo.git
echo.
echo 3. Run this command with YOUR repository URL:
echo    git remote add origin https://github.com/yourusername/buddhabhoomi-ngo.git
echo.
echo 4. Push to GitHub:
echo    git push -u origin main
echo.
echo 5. Deploy on Railway:
echo    - Go to railway.app
echo    - Sign up with GitHub
echo    - Click "New Project"
echo    - Select "Deploy from GitHub repo"
echo    - Choose your buddhabhoomi-ngo repository
echo    - Railway will auto-deploy!
echo.
echo ========================================
echo   ENVIRONMENT VARIABLES FOR RAILWAY:
echo ========================================
echo.
echo Add these in Railway dashboard:
echo.
echo APP_NAME=Buddhabhoomi Human Service Ashram
echo APP_ENV=production
echo APP_DEBUG=false
echo APP_URL=https://your-railway-domain.railway.app
echo.
echo DB_CONNECTION=mysql
echo (Railway will auto-provide database variables)
echo.
echo MAIL_MAILER=smtp
echo MAIL_HOST=smtp.gmail.com
echo MAIL_PORT=587
echo MAIL_USERNAME=info@buddhabhoomi.org.np
echo MAIL_PASSWORD=your-gmail-app-password
echo MAIL_ENCRYPTION=tls
echo MAIL_FROM_ADDRESS=info@buddhabhoomi.org.np
echo MAIL_FROM_NAME=Buddhabhoomi Human Service Ashram
echo.
echo ========================================
echo.
echo Your website will be live in 10-15 minutes after deployment!
echo.
pause