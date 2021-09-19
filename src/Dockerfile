FROM php:8.0-fpm-alpine
RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-configure mysqli --with-mysqli=mysqlnd \
    && docker-php-ext-install pdo_mysql mysqli
COPY --from=composer:2.1.6 /usr/bin/composer /usr/bin/composer
COPY ./composer.json /var/www/html
WORKDIR /var/www/html
RUN composer install
