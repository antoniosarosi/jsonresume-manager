# ----------------------
# The FPM base container
# ----------------------
FROM php:8.0.2-fpm-alpine as dev

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions pdo_mysql gd

WORKDIR /app

# ----------------------
# Composer install step
# ----------------------
FROM composer:2.1.4 as build

WORKDIR /app

COPY composer.* ./
COPY database/ database/

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# ----------------------
# npm install step
# ----------------------
FROM node:12-alpine as node

WORKDIR /app

COPY *.json *.mix.js /app/
COPY resources /app/resources

RUN mkdir -p /app/public \
    && npm install \
    && npm run production

# ----------------------
# The FPM production container
# ----------------------
FROM dev

COPY ./docker/php/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY . /app
COPY --from=build /app/vendor/ /app/vendor/
COPY --from=node /app/public/js/ /app/public/js/
COPY --from=node /app/public/css/ /app/public/css/
COPY --from=node /app/mix-manifest.json /app/public/mix-manifest.json

RUN chmod -R 777 /app/storage
