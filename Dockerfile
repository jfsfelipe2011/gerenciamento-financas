FROM php:7.1-apache
MAINTAINER jfsfelipe2011@gmail.com

COPY . /var/www/html/

RUN apt-get update && apt-get install -y vim

RUN docker-php-source extract \
    # do important things \
    && docker-php-source delete \
    && docker-php-ext-install pdo_mysql