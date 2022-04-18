FROM unit:1.25.0-php7.4

RUN apt-get update -y \
    && apt-get install -y git \
    && docker-php-ext-install pdo pdo_mysql

ADD https://getcomposer.org/installer /tmp/composer
RUN php /tmp/composer --install-dir=/usr/bin --filename=composer

COPY ./core-service/conf/unit/config.json /docker-entrypoint.d/config.json
