# Gunakan image PHP dengan ekstensi yang diperlukan
FROM php:8.1-apache

# Atur izin untuk folder writable dan cache
RUN chmod -R 0777 /var/www/html/writable/cache
RUN chmod -R 0777 /var/www/html/writable/logs