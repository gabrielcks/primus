FROM php:7.4-apache
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_mysql mysqli
ADD php.ini /usr/local/etc/php/conf.d/
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini
