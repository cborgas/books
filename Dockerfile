FROM php:8.2-fpm

WORKDIR /app

COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

RUN apt update && \
    apt install -y libzip-dev libpq-dev && \
    docker-php-ext-install pdo_pgsql && \
    docker-php-ext-enable pdo_pgsql && \
    docker-php-ext-install zip && \
    docker-php-ext-enable zip

WORKDIR /var/www/books

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony
