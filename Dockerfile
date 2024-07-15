# Usa la imagen base de PHP con Apache
FROM php:8.0-apache

# Copia todos los archivos de tu proyecto al directorio raíz del servidor web
COPY . /var/www/html/

# Expone el puerto 80 para que la aplicación esté disponible en HTTP
EXPOSE 80

# Instala las dependencias necesarias
RUN docker-php-ext-install mysqli
