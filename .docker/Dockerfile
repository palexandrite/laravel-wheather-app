FROM composer AS composerExecutable

FROM php:latest

COPY --from=composerExecutable /usr/bin/composer /bin/composer

COPY . /var/www/html/

RUN  apt-get update -y && apt-get install -y \
        git \
        zip \
        unzip \
        # For GMP
        libgmp-dev \
    && pecl install apcu pcov xdebug \
    && docker-php-ext-install gmp mysqli pdo_mysql sockets \
    && docker-php-ext-enable apcu pcov xdebug

RUN composer update --working-dir=/var/www/html

WORKDIR /var/www/html

CMD [ "php", "-S", "0.0.0.0:80", "-t", "public/" ]