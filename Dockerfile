FROM php:7.2.1-apache

RUN apt-get update && apt-get -y --no-install-recommends install git \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html

RUN mkdir /var/www/html/app
RUN mkdir /var/www/html/assets

COPY . .