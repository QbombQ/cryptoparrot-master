FROM php:7.4-fpm-alpine


RUN apk add --no-cache openssl bash nodejs npm postgresql-dev

RUN docker-php-ext-install bcmath pdo pdo_pgsql

WORKDIR /var/www

# Setup GD extension
RUN apk update --no-cache && \
    apk upgrade --no-cache && \
    apk add --no-cache git $PHPIZE_DEPS \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev && \
    docker-php-ext-configure gd && \
    docker-php-ext-install -j$(getconf _NPROCESSORS_ONLN) gd && \
    pecl install xdebug-3.1.5 && \
    docker-php-ext-enable xdebug

RUN rm -rf /var/www/html
RUN ln -s public html

RUN mkdir -p /var/www/storage/framework

RUN mkdir -p /var/www/storage/framework/sessions
RUN mkdir -p /var/www/storage/framework/views
RUN mkdir -p /var/www/storage/framework/cache

RUN chmod -R 777 /var/www/storage/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer self-update --2

EXPOSE 9000

ENTRYPOINT [ "php-fpm" ]
