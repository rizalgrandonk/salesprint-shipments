#!/usr/bin/env bash
set -e

# make sure storage and bootstrap/cache are writable
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache || true

# if vendor not present, install composer deps
if [ ! -d "/var/www/html/vendor" ]; then
  composer install --no-interaction --prefer-dist --optimize-autoloader
fi


# generate key if missing
if [ -f "/var/www/html/artisan" ]; then
  if ! grep -q "APP_KEY=" /var/www/html/.env || [ -z "$(grep -Po '(?<=APP_KEY=).*' /var/www/html/.env)" ]; then
    php artisan key:generate --ansi || true
  fi
  # run pending migrations (optional in prod but handy for home use)
  php artisan migrate --force || true
  php artisan config:cache || true
  php artisan route:cache || true
fi


# drop privileges and exec
exec su-exec www-data "$@"
