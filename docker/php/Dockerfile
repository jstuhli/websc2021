FROM php:8-cli-alpine

RUN apk add --update --no-cache --virtual .build-deps \
        ${PHPIZE_DEPS} \
        postgresql-dev \
    && docker-php-ext-install -j $(getconf _NPROCESSORS_ONLN) \
        pdo_pgsql \
    && apk del --purge .build-deps

RUN apk add --update --no-cache \
    libpq