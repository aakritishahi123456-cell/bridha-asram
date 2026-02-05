@echo off
color 0A
echo.
echo ========================================
echo    🚀 LAUNCH BUDDHABHOOMI NGO WEBSITE
echo ========================================
echo.
echo बुद्धभुमी मानव सेवा आश्रम
echo Buddhabhoomi Human Service Ashram
echo.
echo This script will help you launch your
echo professional NGO website in 15 minutes!
echo.
echo ========================================
echo.

echo Step 1: Checking requirements...
echo.

REM Check if Git is installed
git --version >nul 2>&1
if %errorlevel% neq 0 (
    echo ❌ Git is not installed
    echo Please install Git from: https://git-scm.com/
    echo.
    pause
    exit /b 1
) else (
    echo ✅ Git is installed
)

echo.
echo Step 2: Preparing for deployment...
echo.

REM Initialize Git repository if not already done
if not exist ".git" (
    echo Initializing Git repository...
    git init
    git add .
    git commit -m "Initial commit: Buddhabhoomi NGO website ready for deployment"
    git branch -M main
    echo ✅ Git repository initialized
) else (
    echo ✅ Git repository already exists
)

echo.
echo ========================================
echo    🌐 DEPLOYMENT OPTIONS
echo ========================================
echo.
echo Choose your deployment method:
echo.
echo 1. Railway (RECOMMENDED - Free & Easy)
echo    - Free hosting
echo    - Auto-deployment
echo    - Database included
echo    - SSL certificate
echo    - 15 minutes setup
echo.
echo 2. Vercel (Static hosting)
echo    - Free hosting
echo    - Global CDN
echo    - 10 minutes setup
echo.
echo 3. Manual deployment guide
echo    - Step-by-step instructions
echo    - Multiple hosting options
echo.

set /p choice="Enter your choice (1, 2, or 3): "

if "%choice%"=="1" goto railway
if "%choice%"=="2" goto vercel
if "%choice%"=="3" goto manual
echo Invalid choice. Please run the script again.
pause
exit /b 1

:railway
echo.
echo ========================================
echo    🚂 RAILWAY DEPLOYMENT
echo ========================================
echo.
echo Follow these steps:
echo.
echo 1. CREATE GITHUB REPOSITORY:
echo    - Go to: https://github.com/new
echo    - Repository name: buddhabhoomi-ngo
echo    - Description: Professional NGO website for Buddhabhoomi Human Service Ashram
echo    - Make it PUBLIC (for free hosting)
echo    - Click "Create repository"
echo.
echo 2. PUSH YOUR CODE:
echo    Copy and run these commands:
echo.
echo    git remote add origin https://github.com/YOUR_USERNAME/buddhabhoomi-ngo.git
echo    git push -u origin main
echo.
echo    (Replace YOUR_USERNAME with your GitHub username)
echo.
echo 3. DEPLOY ON RAILWAY:
echo    - Go to: https://railway.app/
echo    - Sign up with GitHub
echo    - Click "New Project"
echo    - Select "Deploy from GitHub repo"
echo    - Choose "buddhabhoomi-ngo"
echo    - Railway will auto-deploy!
echo.
echo 4. ADD ENVIRONMENT VARIABLES in Railway dashboard:
echo.
echo    APP_NAME=Buddhabhoomi Human Service Ashram
echo    APP_ENV=production
echo    APP_DEBUG=false
echo    MAIL_MAILER=smtp
echo    MAIL_HOST=smtp.gmail.com
echo    MAIL_PORT=587
echo    MAIL_USERNAME=info@buddhabhoomi.org.np
echo    MAIL_PASSWORD=your-gmail-app-password
echo    MAIL_ENCRYPTION=tls
echo    MAIL_FROM_ADDRESS=info@buddhabhoomi.org.np
echo.
echo 5. YOUR WEBSITE WILL BE LIVE!
echo    URL: https://your-project-name.railway.app
echo    Admin: https://your-project-name.railway.app/admin
echo    Login: admin@buddhabhoomi.org.np / password
echo.
goto end

:vercel
echo.
echo ========================================
echo    ▲ VERCEL DEPLOYMENT
echo ========================================
echo.
echo Follow these steps:
echo.
echo 1. CREATE GITHUB REPOSITORY (same as Railway steps 1-2)
echo.
echo 2. DEPLOY ON VERCEL:
echo    - Go to: https://vercel.com/
echo    - Sign up with GitHub
echo    - Click "New Project"
echo    - Import your GitHub repository
echo    - Vercel will auto-deploy!
echo.
echo 3. YOUR WEBSITE WILL BE LIVE!
echo    URL: https://your-project-name.vercel.app
echo.
goto end

:manual
echo.
echo ========================================
echo    📖 MANUAL DEPLOYMENT GUIDE
echo ========================================
echo.
echo Opening deployment guide...
echo Please check DEPLOYMENT_GUIDE.md for detailed instructions
echo.
echo Available options:
echo - Railway (Free, recommended)
echo - DigitalOcean ($5/month, professional)
echo - Shared hosting (Budget-friendly)
echo - Netlify (Static hosting)
echo.
goto end

:end
echo.
echo ========================================
echo    📋 POST-DEPLOYMENT CHECKLIST
echo ========================================
echo.
echo After deployment, verify:
echo.
echo ✅ Website loads correctly
echo ✅ Admin panel accessible (/admin)
echo ✅ Donation form works
echo ✅ Volunteer registration works
echo ✅ Email notifications working
echo ✅ SSL certificate active
echo ✅ Mobile responsive
echo.
echo ========================================
echo    📱 ANNOUNCE YOUR LAUNCH
echo ========================================
echo.
echo Share on social media:
echo.
echo Facebook Post:
echo "🎉 बुद्धभुमी मानव सेवा आश्रम को नयाँ वेबसाइट सुरु भयो!
echo.
echo Our new professional website is now live:
echo 🌐 [Your Website URL]
echo.
echo ✨ Features:
echo • Online donations (eSewa/Khalti)
echo • Volunteer registration  
echo • Real-time impact tracking
echo • Multilingual support
echo.
echo Join us in serving the homeless and elderly in Nepal.
echo.
echo #BuddhabhoomiNGO #Nepal #Charity"
echo.
echo ========================================
echo    🎉 CONGRATULATIONS!
echo ========================================
echo.
echo Your professional NGO website is ready to launch!
echo.
echo 🌟 Features included:
echo • Professional design
echo • Donation system (eSewa/Khalti)
echo • Volunteer management
echo • Admin dashboard
echo • Mobile responsive
echo • Multilingual support
echo • Security features
echo • SEO optimized
echo.
echo 💡 Need help?
echo • Check DEPLOYMENT_GUIDE.md
echo • Check LAUNCH_CHECKLIST.md
echo • Contact: info@buddhabhoomi.org.np
echo.
echo Thank you for serving the community! 🙏
echo.
pause