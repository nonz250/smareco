tar -xzf src.tar.gz

cp .htaccess src/.htaccess

cp .env src/.env

cd src/

php -v

# php artisan passport:key

php artisan migrate --force

exit