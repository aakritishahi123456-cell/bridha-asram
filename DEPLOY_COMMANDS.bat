@echo off
color 0A
echo.
echo ========================================
echo    🚀 DEPLOY TO HEROKU - COPY THESE COMMANDS
echo ========================================
echo.
echo बुद्धभुमी मानव सेवा आश्रम
echo Buddhabhoomi Human Service Ashram
echo.
echo Copy and paste these commands one by one:
echo.
echo ========================================
echo.
echo heroku login
echo.
echo heroku create buddhabhoomi-ngo
echo.
echo heroku buildpacks:add heroku/php
echo.
echo heroku buildpacks:add heroku/nodejs
echo.
echo heroku config:set APP_NAME="Buddhabhoomi Human Service Ashram"
echo.
echo heroku config:set APP_ENV=production
echo.
echo heroku config:set APP_DEBUG=false
echo.
echo heroku config:set LOG_CHANNEL=stderr
echo.
echo git push heroku main
echo.
echo ========================================
echo    🎉 YOUR WEBSITE WILL BE LIVE!
echo ========================================
echo.
echo Website: https://buddhabhoomi-ngo.herokuapp.com
echo Admin: https://buddhabhoomi-ngo.herokuapp.com/admin
echo Login: admin@buddhabhoomi.org.np / password
echo.
echo ========================================
echo.
pause