FROM php:8.1-fpm-alpine3.15

ARG UID
ARG GID

RUN apk add \
	bash

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN addgroup --gid ${GID} user
RUN adduser --disabled-password -g 'user' --home /var/www --uid ${UID} --ingroup user user

USER user

WORKDIR /var/www/otjfs.local
