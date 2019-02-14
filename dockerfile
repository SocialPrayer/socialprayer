FROM php:7-cli
RUN apt-get update -y && apt-get install -y openssl zlib1g-dev zip
RUN docker-php-ext-install zip mbstring pdo pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY . /app
WORKDIR /app
RUN composer install --no-interaction
COPY .env-sample .env
EXPOSE 8000
ENTRYPOINT [ "php", "/app/artisan", "serve", "--host=0.0.0.0", "--port=8000" ]