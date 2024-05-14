ARG PHP_VERSION=8.3
FROM php:${PHP_VERSION}-alpine

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN mkdir /app
WORKDIR /app

ARG SYMFONY_VERSION=7.0
ENV SYMFONY_VERSION=${SYMFONY_VERSION}
ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer create-project symfony/skeleton:"${SYMFONY_VERSION}.*" /app
RUN composer require twig form validator
COPY test_project/src src
COPY test_project/templates templates
