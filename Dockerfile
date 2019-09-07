FROM php:7.1-apache
RUN apt-get update && apt-get install --yes --no-install-recommends \
    libssl-dev && apt-get install -y git
RUN pecl install mongodb \
    && docker-php-ext-enable mongodb 
#Set working directory
WORKDIR /var/www/html