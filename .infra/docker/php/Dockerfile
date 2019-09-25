FROM php:7.4-rc-fpm-alpine3.10

WORKDIR "/app"

ADD . /app

ENV BUILD_DEPS="php7-dev alpine-sdk gettext" \
    RUNTIME_DEPS="bash libintl"

RUN set -x && \
    apk add --update $RUNTIME_DEPS && \
    apk add --virtual build_deps $BUILD_DEPS && \
    cp /usr/bin/envsubst /usr/local/bin/envsubst && \
    docker-php-ext-install -j$(getconf _NPROCESSORS_ONLN) iconv pdo pdo_mysql && \
    pecl install apcu apcu_bc && docker-php-ext-enable apcu && \
    apk del build_deps


RUN chown -R www-data:www-data /app

CMD ["php-fpm"]
