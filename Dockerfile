FROM hyperf/hyperf:8.1-alpine-v3.16-swoole

ARG timezone

ENV TIMEZONE=${timezone:-"America/Sao_Paulo"} \
    APP_ENV=dev \
    SCAN_CACHEABLE=(false)

# update
RUN set -ex \
    # show php version and extensions
    && php -v \
    && php -m \
    && php --ri swoole \
    #  ---------- some config ----------
    && cd /etc/php* \
    # - config PHP
    && { \
        echo "upload_max_filesize=128M"; \
        echo "post_max_size=128M"; \
        echo "memory_limit=1G"; \
        echo "date.timezone=${TIMEZONE}"; \
    } | tee conf.d/99_overrides.ini \
    # - config timezone
    && ln -sf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime \
    && apk add php-pgsql \
    && apk add php-pdo_pgsql \
    && echo "${TIMEZONE}" > /etc/timezone \
    && rm -rf /var/cache/apk/* /tmp/* /usr/share/man \
    && echo -e "\033[42;37m Build Completed :).\033[0m\n"

WORKDIR /opt/www

COPY . /opt/www
RUN cp ./.env.example ./.env
RUN composer install && php bin/hyperf.php

ENTRYPOINT ["php", "/opt/www/bin/hyperf.php", "start"]
