# Usa una imagen oficial de PHP con Apache
FROM php:8.2-apache

# Habilita extensiones necesarias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilita mod_rewrite de Apache
RUN a2enmod rewrite

# Copia los archivos del proyecto al contenedor
COPY . /var/www/html/

# Establece permisos correctos
RUN chown -R www-data:www-data /var/www/html/
RUN chmod -R 755 /var/www/html/

# Exponer el puerto 80
EXPOSE 80