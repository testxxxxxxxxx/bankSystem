FROM php:8.1-apache

RUN apt-get update && curl -sSfL https://deb.nodesource.com/setup_18.x | bash -E - && apt install git nodejs -y

RUN docker-php-ext-install pdo_mysql

RUN a2enmod rewrite

ADD ./ /var/www/html/