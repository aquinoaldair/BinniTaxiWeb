FROM php:8.5.0-fpm-bookworm

ARG WWWGROUP=1000
ARG WWWUSER=1000
ARG COMPOSER_VERSION=2.8.12

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        curl \
        unzip \
        libicu-dev \
        libzip-dev \
        libonig-dev \
        libxml2-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j"$(nproc)" \
        bcmath \
        intl \
        pdo_mysql \
        zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2.8.12 /usr/bin/composer /usr/bin/composer

RUN groupadd --gid "${WWWGROUP}" laravel \
    && useradd --uid "${WWWUSER}" --gid laravel --create-home --shell /bin/bash laravel

WORKDIR /var/www/html

RUN chown -R laravel:laravel /var/www/html

USER laravel

CMD ["php-fpm"]
