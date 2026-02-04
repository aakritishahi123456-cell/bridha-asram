#!/bin/bash

echo "🚀 Deploying Buddhabhoomi Human Service Ashram Website..."
echo "=================================================="

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}✅ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

print_error() {
    echo -e "${RED}❌ $1${NC}"
}

# Check if we're in the right directory
if [ ! -f "artisan" ]; then
    print_error "artisan file not found. Please run this script from the Laravel project root."
    exit 1
fi

print_status "Starting deployment process..."

# Step 1: Install dependencies
echo ""
echo "📦 Installing dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction
if [ $? -eq 0 ]; then
    print_status "Composer dependencies installed"
else
    print_error "Failed to install composer dependencies"
    exit 1
fi

npm ci --only=production
if [ $? -eq 0 ]; then
    print_status "NPM dependencies installed"
else
    print_error "Failed to install NPM dependencies"
    exit 1
fi

# Step 2: Build assets
echo ""
echo "🏗️  Building production assets..."
npm run build
if [ $? -eq 0 ]; then
    print_status "Assets built successfully"
else
    print_error "Failed to build assets"
    exit 1
fi

# Step 3: Laravel optimizations
echo ""
echo "⚡ Optimizing Laravel..."

# Generate application key if not exists
if grep -q "APP_KEY=base64:" .env; then
    print_status "Application key already exists"
else
    php artisan key:generate --force
    print_status "Application key generated"
fi

# Cache configuration
php artisan config:cache
print_status "Configuration cached"

# Cache routes
php artisan route:cache
print_status "Routes cached"

# Cache views
php artisan view:cache
print_status "Views cached"

# Step 4: Database operations
echo ""
echo "🗄️  Setting up database..."

# Run migrations
php artisan migrate --force
if [ $? -eq 0 ]; then
    print_status "Database migrations completed"
else
    print_error "Database migrations failed"
    exit 1
fi

# Seed database (only if tables are empty)
php artisan db:seed --force
if [ $? -eq 0 ]; then
    print_status "Database seeded with initial data"
else
    print_warning "Database seeding failed or data already exists"
fi

# Step 5: Storage and permissions
echo ""
echo "📁 Setting up storage..."

# Create storage link
php artisan storage:link
print_status "Storage link created"

# Set proper permissions (if on Linux/Unix)
if [[ "$OSTYPE" == "linux-gnu"* ]] || [[ "$OSTYPE" == "darwin"* ]]; then
    chmod -R 755 storage
    chmod -R 755 bootstrap/cache
    print_status "Permissions set"
fi

# Step 6: Clear caches
echo ""
echo "🧹 Clearing caches..."
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
print_status "All caches cleared"

# Step 7: Final optimizations
echo ""
echo "🔧 Final optimizations..."
php artisan optimize
print_status "Application optimized"

# Step 8: Verify deployment
echo ""
echo "🔍 Verifying deployment..."

# Check if key routes are accessible
php artisan route:list | grep -q "home"
if [ $? -eq 0 ]; then
    print_status "Routes verified"
else
    print_warning "Route verification failed"
fi

# Check database connection
php artisan migrate:status > /dev/null 2>&1
if [ $? -eq 0 ]; then
    print_status "Database connection verified"
else
    print_warning "Database connection issues detected"
fi

echo ""
echo "=================================================="
print_status "🎉 DEPLOYMENT COMPLETED SUCCESSFULLY!"
echo "=================================================="
echo ""
echo "📋 Post-deployment checklist:"
echo "   □ Test website functionality"
echo "   □ Verify admin panel access (/admin)"
echo "   □ Test donation form"
echo "   □ Test volunteer registration"
echo "   □ Check email notifications"
echo "   □ Verify SSL certificate"
echo "   □ Test payment gateways"
echo ""
echo "🌐 Your NGO website is now live and ready to serve!"
echo "   Website: $APP_URL"
echo "   Admin Panel: $APP_URL/admin"
echo "   Login: admin@buddhabhoomi.org.np / password"
echo ""
echo "📞 Support: If you encounter any issues, check the logs:"
echo "   tail -f storage/logs/laravel.log"
echo ""
print_status "Deployment script completed at $(date)"