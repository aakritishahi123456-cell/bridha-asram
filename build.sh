#!/bin/bash

echo "🚀 Building Buddhabhoomi NGO Website..."

# Install PHP dependencies
echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Install Node.js dependencies
echo "📦 Installing Node.js dependencies..."
npm ci --only=production

# Build frontend assets
echo "🏗️ Building frontend assets..."
npm run build

# Laravel optimizations
echo "⚡ Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Build completed successfully!"