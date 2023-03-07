FROM gbmcarlos/php-web:3.1.0

# Add Xdebug
COPY --from=bref/extra-xdebug-php-74:0.10.7 /opt /opt
