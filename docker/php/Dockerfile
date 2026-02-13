FROM php:8.4-fpm

RUN apt-get update -q && \
    apt-get install -y --no-install-recommends \
        libpq-dev \
        libzip-dev \
        zip \
        git \
        zlib1g-dev && \
    docker-php-ext-install zip pdo_mysql && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

RUN groupadd -g 1000 appuser && \
    useradd -u 1000 -g appuser -m appuser && \
    chown -R appuser:appuser /var/www

USER appuser
WORKDIR /var/www/html

CMD ["php-fpm"]
