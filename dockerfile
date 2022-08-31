FROM php:8.0-fpm

RUN docker-php-ext-install pdo_mysql

RUN apt-get update && apt-get install -y \
    libpq-dev \
    zip \
    libmcrypt-dev \
    curl \
    libonig-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libonig-dev \
    libzip-dev \
    cron \
    git \
    && docker-php-ext-install -j$(nproc) pdo \
    && docker-php-ext-install  mbstring \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install opcache

RUN apt-get install supervisor -y

RUN apt-get install -y nginx  && \
    rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . /var/www/html
WORKDIR /var/www/html

RUN chmod +rx /usr/local/bin/composer

# Use the default production configuration
RUN mv "/var/www/html/docker-conf/php.ini" "$PHP_INI_DIR/php.ini"

RUN composer install -vvv

#RUN rm /etc/nginx/sites-enabled/default

COPY docker-conf/deploy.conf /etc/nginx/conf.d/default.conf

RUN mv /usr/local/etc/php-fpm.d/www.conf /usr/local/etc/php-fpm.d/www.conf.backup
COPY docker-conf/www.conf /usr/local/etc/php-fpm.d/www.conf

# COPY .env.dev /var/www/html/.env

RUN usermod -a -G www-data root
RUN chgrp -R www-data storage

RUN chown -R www-data:www-data ./
RUN chmod -R 777 ./storage
RUN chmod -R 777 bootstrap/cache

# RUN php artisan cache:clear
# RUN php artisan config:clear
# RUN php artisan route:clear
# RUN php artisan view:clear
# RUN php artisan route:cache
# RUN php artisan config:cache
#RUN #php artisan passport:install
# # RUN ln -s ./secret/.env .env

RUN chmod +x ./docker-conf/run

ENTRYPOINT ["./docker-conf/run"]

EXPOSE 8182
