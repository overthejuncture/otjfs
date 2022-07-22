FROM php:8.1-fpm-alpine3.15

ARG UID
ARG GID

RUN apk add \
	bash \
	pcre-dev ${PHPIZE_DEPS}

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN pecl install xdebug && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.discover_client_host=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN addgroup --gid ${GID} user
RUN adduser --disabled-password -g 'user' --home /var/www --uid ${UID} --ingroup user user

USER user

WORKDIR /var/www/otjfs.local
