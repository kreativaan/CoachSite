#!/usr/bin/env bash

# Install PHP dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader

# Install Node.js dependencies and build Vue assets
npm install && npm run build

# Cache Laravel config
php artisan config:cache
php artisan route:cache
php artisan view:cache
