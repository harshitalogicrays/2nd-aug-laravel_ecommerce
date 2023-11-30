How to run the code

cd 2nd-aug-laravel-ecommerce

cp .env.example .env

open .env and update DB_DATABASE

run : composer install

run: php artisan key:generate

run: php artisan migrate:fresh --seed

run: php artisan serve
