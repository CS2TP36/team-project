touch ./database/database.sqlite && rm ./database/database.sqlite
php artisan migrate --force
php artisan db:seed
