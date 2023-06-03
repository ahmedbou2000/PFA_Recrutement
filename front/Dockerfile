FROM php:8.1-apache

WORKDIR /app

COPY composer.json .

RUN symfony install

COPY . .

EXPOSE 8000

CMD [ "symfony serve" ]


