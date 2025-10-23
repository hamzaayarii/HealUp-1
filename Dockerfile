# Dockerfile for Laravel + Node + Python (multi-stage)

# --- Build Stage ---
FROM node:20 AS frontend-build
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY resources/ ./resources/
COPY vite.config.js ./
COPY public/ ./public/
RUN npm run build

# --- PHP Composer Stage ---
FROM composer:2.7 AS composer
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --ignore-platform-reqs --no-scripts --no-autoloader --prefer-dist

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
    nginx \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Copy composer dependencies
COPY --from=composer /app/vendor /var/www/html/vendor

# Copy application code
COPY . /var/www/html

# Copy built assets from frontend-build
COPY --from=frontend-build /app/public/build /var/www/html/public/build

# Install PHP dependencies in final image
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Create symbolic link for storage if needed
RUN php artisan storage:link || true

# Configure nginx
COPY <<EOF /etc/nginx/sites-available/default
server {
    listen 8080;
    server_name _;
    root /var/www/html/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF

# Create startup script
COPY <<'EOF' /usr/local/bin/start.sh
#!/bin/bash
set -e

# Start PHP-FPM in background
php-fpm -D

# Run Laravel optimizations
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Start nginx in foreground
nginx -g "daemon off;"
EOF

RUN chmod +x /usr/local/bin/start.sh

EXPOSE 8080

CMD ["/usr/local/bin/start.sh"]
