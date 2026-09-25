#!/bin/sh
set -eu

php artisan migrate --seed --force
php artisan storage:link || true
php artisan route:cache
php artisan view:clear
