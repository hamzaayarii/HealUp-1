# Dockerfile for Laravel + Node + Python (multi-stage)

# --- Build Stage ---
FROM node:20 AS frontend-build
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm install
COPY resources/ ./resources/
COPY vite.config.js ./
RUN npm run build

# --- PHP Composer Stage ---
FROM composer:2.7 AS composer
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --ignore-platform-reqs --no-scripts --no-autoloader

# --- App Stage ---
FROM php:8.2-fpm
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer /app /app
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy application code
COPY . /var/www/html

# Copy built assets from frontend-build
COPY --from=frontend-build /app/resources /var/www/html/resources
COPY --from=frontend-build /app/public/build /var/www/html/public/build


# Install PHP dependencies in final image
RUN composer install --ignore-platform-reqs --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 8080
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]

# --- Python AI Service (optional) ---
# Uncomment if you want to run python_ai as a separate container
# FROM python:3.10 AS python-ai
# WORKDIR /app
# COPY python_ai/ ./
# RUN pip install -r requirements.txt
# CMD ["python", "app.py"]
