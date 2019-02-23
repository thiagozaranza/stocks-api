FROM hitalos/laravel
LABEL MAINTAINER="<thiagozaranza@gmail.com>"

ENV APP_ENV="dev"
ENV APP_NAME="stocks-api"

ADD . /var/www

RUN set -ex \
	&& cd /var/www \
	&& composer install \
	&& php artisan key:generate

WORKDIR /var/www