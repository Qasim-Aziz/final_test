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
RUN mv vhost.conf /etc/apache2/sites-available/000-default.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


RUN mkdir -p /var/www/html/storage/framework/views
RUN mkdir -p /var/www/html/storage/framework/sessions
RUN mkdir -p  /var/www/html/storage/framework/cache

RUN chmod 777 -R bootstrap
RUN chmod 775 -R /var/www/html
RUN chmod -R 777 /var/www/html/storage
RUN chown -R www-data:www-data storage
RUN composer install
RUN chmod 777 -R /var/www/html/storage/logs
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite
