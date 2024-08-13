FROM php:8.2-fpm-alpine
LABEL maintainer="Alan Matias <alanmatias@simbiose.social>"

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apk update && \
    apk add wget

COPY --from=composer /usr/bin/composer /usr/bin/composer

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions ds pdo_pgsql pgsql sockets intl mysqli pdo pdo_mysql

COPY . /var/www/html/

# COMPOSER INSTALL
RUN cd /var/www/html && \
    composer install --no-interaction

WORKDIR /var/www/html

RUN touch ./storage/logs/laravel.log
