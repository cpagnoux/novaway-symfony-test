FROM php:7.2-apache

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite

COPY config/docker-composer-install /usr/local/bin/

RUN apt-get update \
	&& apt-get install -y wget unzip zlib1g-dev mariadb-client \
	&& apt-get clean \
	&& rm -rf /var/lib/apt/lists/* \
	&& docker-php-ext-install zip pdo_mysql \
	&& chmod 755 /usr/local/bin/docker-composer-install \
	&& docker-composer-install \
	&& composer global require hirak/prestissimo

COPY app /var/www/html/
COPY config/app.conf /etc/apache2/sites-enabled/

RUN composer install

COPY config/docker-entrypoint /usr/local/bin/
RUN chmod 755 /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint", "docker-php-entrypoint"]

CMD ["apache2-foreground"]
