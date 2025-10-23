# Base image
FROM php:8.2-apache

# Enable Apache mod_rewrite (CodeIgniter साठी आवश्यक)
RUN a2enmod rewrite

# Copy project files
COPY . /var/www/html/

# Working directory
WORKDIR /var/www/html/

# Permissions
RUN chmod -R 755 /var/www/html/

# Apache config to allow .htaccess override
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
