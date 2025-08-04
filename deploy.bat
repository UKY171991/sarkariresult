@echo off
echo 🚀 Starting deployment of Sarkari Result...

REM Set proper permissions and create directories
echo 📁 Setting up directories...
if not exist "uploads" mkdir uploads
if not exist "cache" mkdir cache

REM Run database setup if needed
echo 🗄️ Setting up database...
if not exist "database\sarkariresult.db" (
    php database\setup.php
    echo ✅ Database setup completed
) else (
    echo ℹ️ Database already exists
)

REM Test configuration
echo 🧪 Testing configuration...
php -f includes\config.php >nul 2>&1 && echo ✅ Main config OK || echo ❌ Main config has issues
php -f admin\config.php >nul 2>&1 && echo ✅ Admin config OK || echo ❌ Admin config has issues

echo ✅ Deployment completed!
echo 🌐 Website should be accessible at: https://job.codeapka.com
echo 🔧 Admin panel should be accessible at: https://job.codeapka.com/admin
echo.
echo 📝 Next steps:
echo 1. Upload all files to your web server
echo 2. Run this script on the server
echo 3. Test the website and admin panel
echo 4. Create your admin user account if needed

pause
