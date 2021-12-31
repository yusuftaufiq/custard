FROM alpine:3.14
LABEL Credit="https://github.com/TrafeX/docker-php-nginx"

# Set env
ENV DB_ADAPTER mysql

# Install packages and remove default server definition
RUN apk add \
  curl \
  nginx \
  php8 \
  php8-ctype \
  php8-curl \
  php8-dom \
  php8-fpm \
  php8-gd \
  php8-intl \
  php8-json \
  php8-mbstring \
  php8-mysqli \
  php8-opcache \
  php8-openssl \
  php8-phar \
  php8-session \
  php8-xml \
  php8-xmlreader \
  php8-zlib \
  php8-pdo_mysql \
  supervisor

# Create symlink so programs depending on `php` still function
RUN ln -s /usr/bin/php8 /usr/bin/php

# Configure nginx
COPY config/nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM
COPY config/fpm-pool.conf /etc/php8/php-fpm.d/www.conf
COPY config/php.ini /etc/php8/conf.d/custom.ini

# Configure supervisord
COPY config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Setup document root
RUN mkdir -p /var/www/html/devcode_todo

# Setup vs code remote server
RUN mkdir -p /.vscode-server

# Make sure files/folders needed by the processes are accessable when they run under the nobody user
RUN chown -R nobody.nobody /var/www/html/devcode_todo && \
  chown -R nobody.nobody /run && \
  chown -R nobody.nobody /var/lib/nginx && \
  chown -R nobody.nobody /var/log/nginx && \
  chown -R nobody.nobody /.vscode-server

# Switch to use a non-root user from here on
USER nobody

# Switch to application directory
WORKDIR /var/www/html/devcode_todo

# Install composer from the official image
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Install composer dependencies
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-progress

# Add application
COPY --chown=nobody ./ /var/www/html/devcode_todo/

# Expose the port nginx is reachable on
EXPOSE 3030

# Run migration also let supervisord start nginx & php-fpm
CMD /var/www/html/devcode_todo/vendor/bin/phinx migrate -q && /usr/bin/supervisord -s -c /etc/supervisor/conf.d/supervisord.conf

# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping
