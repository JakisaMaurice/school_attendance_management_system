# Use official PHP image with Apache
FROM php:8.2-apache

# Enable PHP extensions if needed (like mysqli)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy your project files into the web directory
COPY . /var/www/html/

# Expose port 80
EXPOSE 80
