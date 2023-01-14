FROM gbmcarlos/php-base:3.1.0

COPY ./composer.* ./
RUN composer install \
                -v --no-autoloader --no-dev --no-interaction --no-ansi

## Source code
COPY --chown=www:www ./src ./src

## Composer autoloader
### Now that we've copied the source code, dump the autoloader, optimized by default
RUN composer dump-autoload -v --classmap-authoritative --no-dev --no-interaction --no-ansi

### Project-specific config files
COPY config/php.ini ./php/conf.d/php.ini

## ENV VARS
### Release and other app-defining env vars
### PHP-FPM configuration
### Deployment configuration
ARG APP_RELEASE=latest
ENV APP_RELEASE=$APP_RELEASE \
    APP_NAME=localhost \
    XDEBUG_MODE=off \
    MEMORY_LIMIT="128M"

# Add Xdebug
COPY --from=bref/extra-xdebug-php-74:0.10.7 /opt /opt
