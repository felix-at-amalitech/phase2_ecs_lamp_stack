FROM php:8.3-apache
WORKDIR /var/www/html
COPY ./app /var/www/html
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    && docker-php-ext-install pdo_mysql
EXPOSE 80
CMD ["apache2-foreground"]