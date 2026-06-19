FROM php:8.2-apache

# Installer les extensions PHP nécessaires pour MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Activer le module rewrite d'Apache (nécessaire pour le routing MVC)
RUN a2enmod rewrite

# Configurer le répertoire de travail
WORKDIR /var/www/html

# Ajuster la configuration Apache pour pointer vers le dossier public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copier le projet (optionnel si on utilise des volumes, mais utile pour le build)
COPY . .

# Un clone neuf ne contient pas config/database.php (ignoré par Git).
# Docker génère alors la configuration à partir du modèle compatible variables d'environnement.
RUN if [ ! -f config/database.php ]; then cp config/database.example.php config/database.php; fi

# Donner les droits au serveur web
RUN chown -R www-data:www-data /var/www/html
