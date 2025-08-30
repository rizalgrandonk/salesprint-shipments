.PHONY: up down logs exec composer migrate

up:
    docker compose up -d --build

down:
    docker compose down

logs:
    docker compose logs -f

exec:
    docker exec -it salesprint_backend sh

composer:
    docker exec -it salesprint_backend composer $(args)

migrate:
    docker exec -it salesprint_backend php artisan migrate --force
