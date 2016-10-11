FROM php:7-fpm

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install libmcrypt-dev \
    && docker-php-ext-install -j$(nproc) mcrypt \
    && docker-php-ext-install pdo_mysql \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

WORKDIR "/address-jockey"
