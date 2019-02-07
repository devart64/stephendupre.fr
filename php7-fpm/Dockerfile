FROM php:7.2-fpm
ARG TIMEZONE
ARG UID

MAINTAINER Nicolas TRUGEON <nicolas.trugeon@univ-lr.fr>

RUN apt-get update && apt-get install -y \
    openssl \
    git \
    libzip-dev \
    unzip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

RUN useradd -mu ${UID} monuser

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone
RUN printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini
RUN "date"

# Type docker-php-ext-install to see available extensions
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-configure zip --with-libzip 
RUN docker-php-ext-install zip

RUN if [ "${http_proxy}" != "" ]; then \
    # Needed for pecl to succeed
    pear config-set http_proxy ${http_proxy} \
;fi

# install xdebug
RUN pecl install apcu \
  && docker-php-ext-enable apcu
RUN docker-php-ext-configure opcache --enable-opcache \
  && docker-php-ext-install opcache
RUN { \
		echo 'opcache.memory_consumption=128'; \
		echo 'opcache.interned_strings_buffer=8'; \
		echo 'opcache.max_accelerated_files=4000'; \
		echo 'opcache.revalidate_freq=60'; \
		echo 'opcache.fast_shutdown=1'; \
		echo 'opcache.enable_cli=1'; \
	} > /usr/local/etc/php/conf.d/opcache-recommended.ini

RUN echo "realpath_cache_size = 4096k; realpath_cache_ttl = 7200;" > /usr/local/etc/php/conf.d/php.ini
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN echo "error_reporting = E_ALL" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "display_startup_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "display_errors = On" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_connect_back=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.idekey=\"PHPSTORM\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.remote_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN echo 'alias sf="php bin/console"' >> /home/monuser/.bashrc

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV http_proxy ${http_proxy}

WORKDIR /var/www/docker/

#RUN mkdir -p /var/www/docker
#RUN composer create-project symfony/skeleton symfony -d /var/www/docker
#RUN chown -R monuser:www-data /var/www/docker/symfony

