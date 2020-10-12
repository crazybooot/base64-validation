FROM php:7.1-cli-alpine

RUN apt-get update && apt-get install -y php7.1-gd php7.1-xml php7.1-imagick

ADD entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh
ENTRYPOINT [ "/entrypoint.sh" ]