FROM php:8.2.11-fpm

ARG user
ARG uid

RUN apt-get update && apt-get install -y \
    git zip unzip  \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && rm -rf /var/lib/apt/lists/* 


COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

COPY ./src /var/www

RUN composer global require laravel/installer:^5.4

RUN echo 'export PATH="$PATH:$HOME/.composer/vendor/bin"' >> ~/.bashrc


RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

RUN echo "max_file_uploads=100" >> /usr/local/etc/php/conf.d/docker-php-ext-max_file_uploads.ini
RUN echo "post_max_size=120M" >> /usr/local/etc/php/conf.d/docker-php-ext-post_max_size.ini
RUN echo "upload_max_filesize=120M" >> /usr/local/etc/php/conf.d/docker-php-ext-upload_max_filesize.ini

WORKDIR /var/www

USER $user
