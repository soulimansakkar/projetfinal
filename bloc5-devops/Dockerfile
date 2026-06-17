FROM php:8.1-apache

RUN docker-php-ext-install pdo pdo_mysql

# copier les fichiers de l'appli
COPY . /var/www/html

EXPOSE 80
