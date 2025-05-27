FROM php:8.2-fpm

# System dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install Node.js 18.x und npm
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs

# Verify installation
RUN node -v && npm -v

# PHP Extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Composer installieren
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# PHP-Konfiguration kopieren
COPY php.ini /usr/local/etc/php/conf.d/custom.ini

# Benutzer erstellen und Berechtigungen setzen
RUN groupadd -g 1000 www \
    && useradd -u 1000 -ms /bin/bash -g www www

# Arbeitsverzeichnis setzen
WORKDIR /var/www

# Container als nicht-root Benutzer starten
USER www

EXPOSE 9000
CMD ["php-fpm"]