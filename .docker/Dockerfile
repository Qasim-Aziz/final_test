FROM php:7.4.1-apache

USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && docker-php-source delete
COPY . .
COPY vhost.conf /etc/apache2/sites-available/000-default.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN mkdir -p /var/www/html/storage/framework/sessions
RUN composer install
RUN mkdir -p /storage/framework/view
RUN mkdir -p /storage/framework/sessions
RUN mkdir -p /storage/framework/cache
RUN chmod 777 /var/www/html/storage/logs/laravel.log
RUN chmod 775 /var/www/html


RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite
