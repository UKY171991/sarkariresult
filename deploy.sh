#!/bin/bash
# Deployment script for Sarkari Result website

echo "🚀 Starting deployment of Sarkari Result..."

# Set proper permissions for database directory
echo "📁 Setting database permissions..."
chmod 755 database/
chmod 666 database/sarkariresult.db 2>/dev/null || echo "Database file will be created on first access"

# Set proper permissions for upload directories (if any)
echo "📁 Setting upload permissions..."
mkdir -p uploads/
chmod 755 uploads/

# Set proper permissions for cache directories (if any)
mkdir -p cache/
chmod 755 cache/

# Secure sensitive files
echo "🔒 Securing sensitive files..."
chmod 600 includes/config.php 2>/dev/null || true
chmod 600 admin/config.php 2>/dev/null || true
chmod 600 database/*.sql 2>/dev/null || true

# Run database setup if needed
echo "🗄️ Setting up database..."
if [ ! -f "database/sarkariresult.db" ]; then
    php database/setup.php
    echo "✅ Database setup completed"
else
    echo "ℹ️ Database already exists"
fi

# Clear any cache files
echo "🧹 Clearing cache..."
rm -rf cache/* 2>/dev/null || true

# Test configuration
echo "🧪 Testing configuration..."
php -f includes/config.php && echo "✅ Main config OK" || echo "❌ Main config has issues"
php -f admin/config.php && echo "✅ Admin config OK" || echo "❌ Admin config has issues"

echo "✅ Deployment completed!"
echo "🌐 Website should be accessible at: https://job.codeapka.com"
echo "🔧 Admin panel should be accessible at: https://job.codeapka.com/admin"
echo ""
echo "📝 Next steps:"
echo "1. Upload all files to your web server"
echo "2. Run this script on the server: bash deploy.sh"
echo "3. Test the website and admin panel"
echo "4. Create your admin user account if needed"
