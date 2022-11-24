FROM php:8.1-apache

RUN docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite \

RUN apt-get install -y git-core curl build-essential openssl libssl-dev \
 && git clone https://github.com/nodejs/node.git \
 && cd node \
 && ./configure \
 && make \
 && sudo make install
