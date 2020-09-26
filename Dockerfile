FROM php:7.4.1-apache

USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
        libpng-dev \
        apt-utils \
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


RUN rm -f /etc/apache2/sites-available/default-ssl.conf
COPY default-ssl.conf /etc/apache2/sites-available
COPY hydria-web.crt /etc/ssl/certs
COPY hydria-web.key /etc/ssl/private
RUN chmod 777 -R bootstrap
RUN chmod 775 -R /var/www/html
RUN chmod 777 -R /var/www/html/storage
RUN chown -R www-data:www-data /var/www/html/storage
RUN chown www-data:www-data /etc/ssl/certs/hydria-web.crt
RUN chown www-data:www-data /etc/ssl/private/hydria-web.key

RUN chmod 777 -R /var/www/html/storage/logs

RUN composer clear-cache
RUN composer update
RUN chown -R www-data:www-data /var/www/html \
    && a2enmod rewrite \
    && a2enmod ssl \
    && a2enmod headers
    
RUN /etc/init.d/apache2 reload && a2ensite default-ssl
RUN /etc/init.d/apache2 reload
