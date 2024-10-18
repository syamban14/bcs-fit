# Gunakan image PHP dengan ekstensi yang diperlukan
FROM php:8.1-apache

# Set environment variables jika perlu
ENV APP_ENV=production

# Instal dependensi, termasuk ekstensi PHP yang dibutuhkan
RUN apt-get update && \
    apt-get install -y libzip-dev unzip && \
    docker-php-ext-install zip pdo pdo_mysql

# Copy file aplikasi ke container
COPY . /var/www/html

# Pindah ke folder aplikasi
WORKDIR /var/www/html

# Install composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install --no-dev --optimize-autoloader

# Atur izin untuk folder writable dan cache
RUN chmod -R 0777 /var/www/html/writable/cache
RUN chmod -R 0777 /var/www/html/writable/logs

# Expose port 80 untuk server Apache
EXPOSE 80

# Jalankan Apache di container
CMD ["apache2-foreground"]
