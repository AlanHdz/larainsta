FROM php:8.0.5-fpm-alpine

WORKDIR /var/www/html

RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

RUN chown -R www-data:www-data /var/www

RUN docker-php-ext-install pdo pdo_pgsql pgsql
