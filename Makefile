SHELL := /bin/sh

.PHONY: up down build restart logs ps bash-app bash-node composer-install npm-install npm-build migrate fresh

up:
	docker compose up -d

build:
	docker compose up -d --build

down:
	docker compose down

restart:
	docker compose down
	docker compose up -d

logs:
	docker compose logs -f

ps:
	docker compose ps

bash-app:
	docker compose exec app bash

bash-node:
	docker compose exec node sh

composer-install:
	docker compose exec app composer install

npm-install:
	docker compose exec node npm install

npm-build:
	docker compose exec node npm run build

migrate:
	docker compose exec app php artisan migrate

fresh:
	docker compose exec app php artisan migrate:fresh --seed
