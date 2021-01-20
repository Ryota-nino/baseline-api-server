FROM php:7.3.26-fpm

COPY . /var/www

WORKDIR /var/www

RUN apt-get update -y && apt-get install -y zip unzip

RUN docker-php-ext-install pdo mbstring pdo_mysql

# composerを持ってくる処理
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN composer install

RUN chmod -R 777 /var/www/storage \
        /var/www/bootstrap/cache

RUN php artisan key:generate && \
    php artisan config:clear && \
    php artisan config:cache && \
    php artisan optimize && \
    php artisan storage:link
