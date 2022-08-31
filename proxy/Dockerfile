FROM php:7.2-apache
COPY src/ /var/www/html/
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get update -y && apt-get install -y curl && apt-get clean -y
RUN apt-get update && apt-get upgrade -y
