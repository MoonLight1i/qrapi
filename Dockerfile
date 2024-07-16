# Utiliza una imagen base de PHP con Apache
FROM php:8.0-apache

# Copia tu código fuente al contenedor
COPY . /var/www/html/

# Instala dependencias de Composer si es necesario
# COPY composer.json composer.lock /var/www/html/
# WORKDIR /var/www/html
# RUN composer install

# Exponer el puerto 8080
EXPOSE 8080

# Configura Apache para escuchar en el puerto 8080
RUN sed -i 's/80/8080/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Inicia Apache en el primer plano
CMD ["apache2-foreground"]
