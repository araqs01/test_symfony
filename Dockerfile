FROM php:8.1-cli

RUN apt-get update && apt-get install -y default-mysql-client libzip-dev unzip libonig-dev libpng-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql zip mbstring xml

WORKDIR /app
