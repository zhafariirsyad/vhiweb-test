# Gunakan image dasar PHP dengan Alpine
FROM php:8.3-fpm-alpine

# Install dependensi yang diperlukan untuk ekstensi PHP, Composer, dan Node.js
RUN apk add --no-cache \
    libpng libpng-dev \
    libjpeg-turbo libjpeg-turbo-dev \
    libwebp libwebp-dev \
    zlib zlib-dev \
    libxml2 libxml2-dev \
    oniguruma oniguruma-dev \
    freetype freetype-dev \
    bash \
    git \
    nodejs \
    npm \
    && docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
        --with-webp \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo pdo_mysql

# Set working directory
WORKDIR /var/www/html/src

# Salin file composer.json dan composer.lock dari folder src
COPY src/composer.lock src/composer.json ./

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install dependencies menggunakan Composer
RUN composer install --no-autoloader --no-scripts

# Salin file package.json dan package-lock.json dari folder src
COPY src/package.json ./

# Install dependencies menggunakan npm
RUN npm install

# Set permission untuk file dan direktori node_modules
RUN chmod -R 755 /var/www/html/src/node_modules

# Salin sisa kode aplikasi
COPY src/ .

# Generate autoload files
RUN composer dump-autoload --optimize

# Jalankan build menggunakan Vite
RUN npm run build

# Set permissions
RUN chown -R www-data:www-data /var/www/html/src/storage /var/www/html/src/bootstrap/cache \
    && chmod -R 775 /var/www/html/src/storage /var/www/html/src/bootstrap/cache

# Finish