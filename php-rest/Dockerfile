FROM php:7.0-apache
ARG buildno
RUN echo "Build number: $buildno"
RUN docker-php-ext-install mysqli
COPY . /var/www/html/
