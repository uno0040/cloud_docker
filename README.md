# Como configurar este projeto:

cp .env.example .env

docker compose up -d

docker exec -it app bash

composer install (se não der certo utilizar compose update primeiro)

php artisan key:generate

php artisan migrate

php artisan serve --host=0.0.0.0 --port=8000

# Conectar por HTTP (nao https)
