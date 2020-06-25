FROM php:7.4-fpm-alpine

COPY . /var/www/parking
WORKDIR /var/www/parking

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Mysql pdo drivers
RUN docker-php-ext-install pdo pdo_mysql

RUN chown -R www-data:www-data /var/www/parking
