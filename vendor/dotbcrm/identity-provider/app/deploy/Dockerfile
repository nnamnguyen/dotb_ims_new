FROM php:7.1-apache

RUN apt-get update && apt-get install -y \
        zlib1g-dev \
        libmcrypt-dev \
        libxml2-dev \
        libssl-dev \
        libldap2-dev \
        libsasl2-dev \
        libgmp-dev \
        unzip \
        libaio1 \
        --no-install-recommends \
    && ln -fs /usr/lib/x86_64-linux-gnu/libldap.so /usr/lib/ \
    && ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h \
    && docker-php-ext-configure ldap --with-ldap-sasl --with-ldap \
    && docker-php-ext-install mcrypt zip mysqli pdo_mysql gmp ldap \
    && pecl install apcu \
    && pecl install apcu_bc \
    && pecl install grpc \
    && docker-php-ext-enable apcu --ini-name 10-docker-php-ext-apcu.ini \
    && docker-php-ext-enable apc --ini-name 20-docker-php-ext-apc.ini \
    && docker-php-ext-enable grpc \
    && apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false -o \
    APT::AutoRemove::SuggestsImportant=false

# Apache set up
RUN a2enmod rewrite
COPY app/deploy/apache/identity-provider.conf /etc/apache2/sites-available
COPY app/deploy/apache/php.ini /usr/local/etc/php
RUN a2dissite 000-default.conf default-ssl.conf
RUN a2ensite identity-provider.conf

# Identity Provider setup
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www/html
COPY . /var/www/html
RUN composer install
RUN app/deploy/prepare.sh
RUN set -ex \
    && . "$APACHE_ENVVARS" \
    && chown -R "$APACHE_RUN_USER:$APACHE_RUN_GROUP" /var/www/html/var

EXPOSE 80
CMD ["apache2-foreground"]
