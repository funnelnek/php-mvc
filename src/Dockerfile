FROM php:8.1.0-fpm-alpine3.15

ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="1" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="10000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="192" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10"

RUN apk add --update curl-dev \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \    
    && docker-php-ext-install pdo_mysql mysqli opcache curl
COPY --from=composer:2.1.6 /usr/bin/composer /usr/bin/composer
COPY ./composer.json /var/www/html
WORKDIR /var/www/html
RUN chown 1000:1000 . && \
    composer install
USER 1000
