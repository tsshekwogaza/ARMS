#!/usr/bin/env bash

# Exit immediately if a command exits with a non-zero status
set -e

echo "🚀 Starting production deployment optimizations..."

# Cache configuration, routes, and views for lightning-fast production performance
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "🗄️ Running database migrations..."
# Run migrations automatically without manual confirmation prompts
php artisan migrate --force

echo "✅ Deployment optimizations complete!"
