FROM alpine:3.15
LABEL Credit="https://github.com/TrafeX/docker-php-nginx"

# Set env
ENV DB_ADAPTER mysql

# Install packages and remove default server definition
RUN apk --repository https://dl-cdn.alpinelinux.org/alpine/edge/testing/ add \
  curl \
  nginx \
  php81 \
  php81-ctype \
  php81-curl \
  php81-dom \
  php81-fpm \
  php81-gd \
  php81-intl \
  php81-json \
  php81-mbstring \
  php81-mysqli \
  php81-opcache \
  php81-openssl \
  php81-phar \
  php81-session \
  php81-xml \
  php81-xmlreader \
  php81-zlib \
  php81-pdo_mysql \
  supervisor

  # php81-pecl-memcached \
  # memcached

# Create symlink so programs depending on `php` still function
RUN ln -s /usr/bin/php81 /usr/bin/php

# Configure nginx
COPY config/nginx.conf /etc/nginx/nginx.conf

# Configure PHP-FPM
COPY config/fpm-pool.conf /etc/php81/php-fpm.d/www.conf
COPY config/php.ini /etc/php81/conf.d/custom.ini

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

# Remove unused files
RUN rm -r /var/www/html/devcode_todo/config

# Expose the port nginx is reachable on
EXPOSE 3030

# Show system informations
# printf " ------ CPUINFO ------ \r\n" && cat /proc/cpuinfo &&  \
#   printf " ------ MEMINFO ------ \r\n" && cat /proc/meminfo && \
#   printf " ------ NPROC ------ \r\n" && nproc --all && \

# Prevent MySQL TABLE STATUS from cached
# mysql -u "$MYSQL_USER" -p"$MYSQL_PASSWORD" -h "$MYSQL_HOST" -P 3306 -D "$MYSQL_DBNAME" -e "SET PERSIST information_schema_stats_expiry = 0" && \

# Run migration
# Let supervisord start nginx & php-fpm
CMD /var/www/html/devcode_todo/vendor/bin/phinx migrate && \
  /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf

# Configure a healthcheck to validate that everything is up&running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:8080/fpm-ping
