#!/bin/bash

cd /var/www/html/tool-rocks
php artisan down
git pull origin master
composer install --no-dev --optimize-autoloader
npm run production
php artisan up
