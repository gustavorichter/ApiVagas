FROM php:8.0-apache

# Instala as extensões necessárias do PHP
RUN docker-php-ext-install pdo_mysql mysqli

RUN pecl install xdebug && docker-php-ext-enable xdebug

# Habilita o módulo rewrite do Apache
RUN a2enmod rewrite
# Habilitar o módulo headers_module
RUN a2enmod headers

# Define a document root do Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN mkdir -p /tmp/xdebug/profiler && chmod 777 -R /tmp/xdebug/profiler && ls -la /tmp/xdebug/profiler
WORKDIR /var/www/html

# Copia o código fonte do projeto para dentro do container
COPY . /var/www/html/

# Define as permissões corretas para as pastas do projeto
RUN chown -R www-data:www-data /var/www/html/
RUN chmod -R 755 /var/www/html/

# Expõe a porta 80 do container
EXPOSE 80
