FROM phpdockerio/php71-fpm:latest

LABEL maintainer="TiagoDevWeb"

ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
    && apt-get -y --no-install-recommends install php7.1-sqlite3 php7.1-gd php7.1-xml php7.1-imagick php-xdebug git \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

ADD entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT [ "/entrypoint.sh" ]