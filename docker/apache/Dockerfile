
FROM php:8.0-apache
#Install git
RUN apt-get update \
#    && apt-get install -y git
    && apt-get install -y nano 
#RUN apt-get install -y --no-install-recommends apt-utils zlib1g-dev \
#	&&docker-php-ext-install zip
RUN apt-get install -y libzip-dev
RUN apt-get install -y libpng-dev 
RUN apt-get install -y libfreetype6-dev 
RUN apt-get install -y zlib1g-dev 
RUN apt-get install -y libjpeg62-turbo-dev 
RUN apt-get install -y libmagickwand-dev
#RUN apt-get install -y mysql-client

RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo pdo_mysql mysqli
RUN a2enmod rewrite
RUN docker-php-ext-configure gd --with-freetype --with-jpeg 
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install soap
RUN docker-php-ext-enable soap
ENV PHP_MEMORY_LIMIT=528M
#Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
EXPOSE 80
