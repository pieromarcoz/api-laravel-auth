# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Install additional PHP extensions if needed
RUN docker-php-ext-install pdo pdo_mysql

# Run composer install to install dependencies
RUN composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader

# Generate application key
RUN php artisan key:generate

# Set permissions
RUN chown -R nginx:nginx /var/www/html \
    && chmod -R 755 /var/www/html/storage

CMD ["/start.sh"]
