# Stage 1: Node for asset building
FROM node:20 AS frontend-builder
WORKDIR /app

# Copy package.json and install dependencies
COPY package*.json vite.config.* ./
RUN npm install

# Copy all source code and build frontend
COPY . .
RUN npm run build

# Stage 2: PHP-FPM + Composer
FROM php:8.2-fpm AS backend
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev zip git unzip && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo_mysql gd && \
    rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy backend source
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy built frontend assets from Node build
COPY --from=frontend-builder /app/public/build ./public/build

# Laravel storage setup
RUN chown -R www-data:www-data storage bootstrap/cache

CMD ["php-fpm"]
