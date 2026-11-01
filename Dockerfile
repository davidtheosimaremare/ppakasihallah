FROM php:8.2-apache

# Install dependencies for extensions (gd, zip, mysqli, pdo_mysql)
RUN apt-get update && apt-get install -y --no-install-recommends \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) mysqli pdo_mysql gd zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Configure PHP settings
RUN echo "memory_limit=512M\n\
upload_max_filesize=64M\n\
post_max_size=64M\n\
max_execution_time=300\n\
display_errors=Off\n\
log_errors=On" > /usr/local/etc/php/conf.d/custom.ini

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . /var/www/html/

# Ensure proper permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]
