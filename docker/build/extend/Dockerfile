FROM wujidadi/nginx-php:2.2

ARG phpversion=8.2

RUN mkdir /run/php-fpm;\
    chown www-data /run/php-fpm

CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
