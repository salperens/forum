# PHP 8.2 FPM base image
FROM php:8.2-fpm

# Sistem güncellemeleri ve gerekli paketlerin yüklenmesi
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libonig-dev \
    libzip-dev \
    zip \
    nginx \
    supervisor \
    && docker-php-ext-install intl pdo_mysql zip opcache

# Composer'ı yükleme
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Çalışma dizinini ayarlıyoruz
WORKDIR /var/www/forum

# Gerekli PHP ayarlarını yapıyoruz
COPY ./docker/php/conf.d /usr/local/etc/php/conf.d

# Nginx ayarlarını kopyalıyoruz
COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/snippets/fastcgi-php.conf /etc/nginx/snippets/fastcgi-php.conf

# Supervisord konfigürasyon dosyasını kopyalıyoruz
COPY ./docker/supervisor/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Proje dosyalarını kopyalıyoruz
COPY . /var/www/forum

# Proje dizininde çalıştırılabilir komutları ve hakları ayarlıyoruz
RUN chown -R www-data:www-data /var/www/forum \
    && chmod -R 755 /var/www/forum

RUN composer install --no-scripts --no-autoloader

EXPOSE 80

CMD ["/usr/bin/supervisord"]