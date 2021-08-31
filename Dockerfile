FROM php:7.4-fpm-alpine

RUN sed -i 's/9000/9001/' /usr/local/etc/php-fpm.d/zz-docker.conf

RUN apk update && apk add --no-cache \
    bash \
    icu-dev \
    imap-dev \
    libpng-dev \
    libzip-dev \
    shadow \
    vim \
    zlib-dev

RUN docker-php-ext-install \
    bcmath \
    gd \
    imap \
    intl \
    pcntl \
    pdo_mysql \
    zip \
    sockets

# Install composer
ENV COMPOSER_HOME /composer
ENV PATH ./vendor/bin:/composer/vendor/bin:$PATH
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

# Setup working directory
WORKDIR /var/www

# Add user for laravel application
RUN addgroup --gid 1000 www && adduser -S www -G www

# Copy existing application directory contents
COPY composer.* ./
RUN composer install --no-scripts --no-dev
COPY . /var/www

# Copy existing application directory permissions
COPY --chown=www:www . /var/www

# Change current user to www
USER www

# list folder
RUN ls -la public
# Expose port 9001 and start php-fpm server
EXPOSE 9001
CMD ["php-fpm"]