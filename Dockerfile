FROM php:8.0.5-fpm-alpine

WORKDIR /var/www/html

RUN set -ex \
  && apk --no-cache add \
    postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql pgsql
