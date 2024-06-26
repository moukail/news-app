FROM node:lts-alpine3.19 AS node
FROM php:8.3-fpm-alpine3.19

ENV TIMEZONE 'UTC'

RUN apk --update --no-cache add linux-headers bash wget gcc g++ make autoconf rabbitmq-c-dev rabbitmq-c libsodium-dev openssh rsync git
RUN docker-php-ext-install -j$(nproc) pdo_mysql

RUN pecl install amqp xdebug redis libsodium && docker-php-ext-enable amqp xdebug redis opcache

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && sed -i "s|;date.timezone =.*|date.timezone = ${TIMEZONE}|" /usr/local/etc/php/php.ini \
    && sed -i "s|memory_limit =.*|memory_limit = -1|" /usr/local/etc/php/php.ini

RUN echo $'zend_extension=xdebug.so \n\
xdebug.default_enable=1 \n\
xdebug.remote_enable=1 \n\
xdebug.remote_host=host.docker.internal '\
> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
# Symfony CLI
RUN wget https://get.symfony.com/cli/installer -O - | bash && mv /root/.symfony5/bin/symfony /usr/bin/symfony

### Codeception
RUN wget http://codeception.com/codecept.phar -O /usr/bin/codecept && chmod a+x /usr/bin/codecept

RUN addgroup _www && adduser -S -H --ingroup _www _www

COPY --from=node /usr/local /usr/local
COPY --from=node /opt /opt

WORKDIR /var/www/web

ADD install.sh /home/
RUN chmod +x /home/install.sh
#CMD bash /home/install.sh

ADD docker-init.sh /home/
RUN chmod +x /home/docker-init.sh
CMD bash /home/docker-init.sh
