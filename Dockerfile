# Start from PHP 5.6
# Take a look at the PHP container documentation on the Dockerhub for more detailed
# info on running the container: https://hub.docker.com/_/php/
FROM php:5.6

# Installing git to install dependencies later and necessary libraries for postgres
# and mysql including client tools. You can remove those if you don't need them for your build.
RUN apt-get update && \
    apt-get install -y \
      git \
      libpq-dev \
      postgresql-client \
      mysql-client

# Install tools and applications through pear. Binaries will be accessible in your PATH.
RUN pear install pear/PHP_CodeSniffer

# Install extensions through pecl and enable them through ini files
RUN pecl install hrtime
RUN echo "extension=hrtime.so" > $PHP_INI_DIR/conf.d/hrtime.ini

# Install Composer and make it available in the PATH
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

# Install extensions through the scripts the container provides
# Here we install the pdo_pgsql and pdo_mysql extensions to access PostgreSQL and MySQL.
RUN docker-php-ext-install pdo_pgsql
RUN docker-php-ext-install pdo_mysql

# Set the WORKDIR to /app so all following commands run in /app
WORKDIR /app

# Copy composer files into the app directory.
COPY composer.json composer.lock ./

# Install dependencies with Composer.
# --prefer-source fixes issues with download limits on Github.
# --no-interaction makes sure composer can run fully automated
RUN composer install --prefer-source --no-interaction

COPY . ./
