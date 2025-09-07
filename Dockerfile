FROM php:8.3.16-apache-bullseye

RUN a2enmod rewrite
RUN apt-get update -y \
    && apt-get install -y --no-install-recommends \
        libxml2-dev \
        git \
        unzip \
        libzip-dev \
        wget \
        vim \
    && apt-get clean -y \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


RUN docker-php-ext-configure pcntl --enable-pcntl
RUN docker-php-ext-configure intl
RUN docker-php-ext-install \
    opcache \
    intl \
    pcntl


RUN mkdir -p /usr/src/php/ext/ \
    && cd /usr/src/php/ext/ \
    && wget https://github.com/xdebug/xdebug/archive/3.3.1.tar.gz \
    && tar -xzf 3.3.1.tar.gz \
    && rm 3.3.1.tar.gz \
    && mv xdebug-3.3.1/ xdebug/ && docker-php-ext-install xdebug

RUN rm $PHP_INI_DIR/conf.d/docker-php-ext-xdebug.ini

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --filename=composer --install-dir=/usr/bin \
    && php -r "unlink('composer-setup.php');"
