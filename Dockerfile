# Imagem base leve com Apache e PHP
FROM php:8.2-apache

# Instala extensões necessárias do PHP para Laravel e MySQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Ativa o mod_rewrite do Apache (necessário para Laravel)
RUN a2enmod rewrite

# Copia os arquivos do projeto para o container
COPY . /var/www/html

# Ajusta permissões
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Define o diretório de trabalho
WORKDIR /var/www/html

RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Instala o Composer
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# Expõe a porta 80
EXPOSE 80
