web: $(composer config bin-dir)/heroku-php-nginx -C nginx.conf public/
queue: php artisan queue:work --sleep=3 --tries=3 --timeout=600 --daemon
