# Use a more commonly available PHP version
FROM php:8.2-apache

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /var/www/html/

COPY . .

EXPOSE 80