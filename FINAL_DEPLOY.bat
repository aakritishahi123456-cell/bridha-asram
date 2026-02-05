@echo off
color 0A
echo.
echo ========================================
echo    🚀 FINAL DEPLOYMENT - FIXED VERSION
echo ========================================
echo.
echo Your deployment issues have been FIXED!
echo.
echo STEP 1: After creating GitHub repository, run:
echo.
echo git remote add origin https://github.com/YOUR_USERNAME/buddhabhoomi-ngo.git
echo git push -u origin main
echo.
echo (Replace YOUR_USERNAME with your actual GitHub username)
echo.
echo STEP 2: Deploy on Railway:
echo 1. Go to: https://railway.app/
echo 2. Sign up with GitHub
echo 3. Click "New Project"
echo 4. Select "Deploy from GitHub repo"
echo 5. Choose "buddhabhoomi-ngo"
echo 6. Railway will auto-deploy with the fixes!
echo.
echo STEP 3: Add Environment Variables in Railway:
echo.
echo APP_NAME=Buddhabhoomi Human Service Ashram
echo APP_ENV=production
echo APP_DEBUG=false
echo APP_KEY=base64:WILL_BE_GENERATED_AUTOMATICALLY
echo.
echo MAIL_MAILER=smtp
echo MAIL_HOST=smtp.gmail.com
echo MAIL_PORT=587
echo MAIL_USERNAME=info@buddhabhoomi.org.np
echo MAIL_PASSWORD=your-gmail-app-password
echo MAIL_ENCRYPTION=tls
echo MAIL_FROM_ADDRESS=info@buddhabhoomi.org.np
echo.
echo ========================================
echo    ✅ FIXES APPLIED:
echo ========================================
echo.
echo ✅ Added nixpacks.toml for proper build
echo ✅ Fixed console routes issue
echo ✅ Simplified Railway configuration
echo ✅ Optimized deployment process
echo.
echo ========================================
echo    🎉 RESULT:
echo ========================================
echo.
echo Your website will be live at:
echo https://your-project-name.railway.app
echo.
echo Admin panel:
echo https://your-project-name.railway.app/admin
echo Login: admin@buddhabhoomi.org.np / password
echo.
echo Total deployment time: 10-15 minutes
echo.
pause