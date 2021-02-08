FROM php:7.3-apache

WORKDIR /workspace

RUN pecl install xdebug && \
  docker-php-ext-enable xdebug

RUN service apache2 start

