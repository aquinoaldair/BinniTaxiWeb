# BinniTaxi

Proyecto Laravel 13 con entorno Docker fijo para desarrollo local.

## Versiones fijadas

- PHP `8.5.0-fpm-bookworm`
- Composer `2.8.12`
- Nginx `1.28.0-alpine`
- PostgreSQL `18.3`

## Levantar el proyecto

```bash
docker compose up -d --build
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
```

La aplicación queda disponible en `http://localhost:8001`.
Vite queda disponible en `http://localhost:5173`.

## Comandos rápidos

Con `make`:

```bash
make build
make up
make down
make logs
make ps
make migrate
make composer-install
make npm-build
make bash-app
make bash-node
```

## Servicios

- `app`: contenedor PHP-FPM con las extensiones mínimas para Laravel
- `nginx`: servidor web expuesto en el puerto `8001`
- `db`: PostgreSQL `18.3` expuesta en el puerto `5433`
- `node`: Vite sobre Node `22.12.0-alpine` expuesto en el puerto `5173`

## Base de datos

Las credenciales por defecto dentro de Docker son:

```env
DB_CONNECTION=pgsql
DB_HOST=db
DB_PORT=5432
DB_DATABASE=binnitaxi
DB_USERNAME=binnitaxi
DB_PASSWORD=binnitaxi
DB_SCHEMA=public
DB_SSLMODE=prefer
```

Para conectarte desde el host, por ejemplo desde PhpStorm:

```env
DB_HOST=127.0.0.1
DB_PORT=5433
DB_DATABASE=binnitaxi
DB_USERNAME=binnitaxi
DB_PASSWORD=binnitaxi
DB_SCHEMA=public
DB_SSLMODE=prefer
```

## Frontend con Docker

Para iniciar también el entorno frontend:

```bash
docker compose up -d
```

El servicio `node` instala dependencias con `npm` dentro del contenedor y levanta Vite en modo desarrollo.

Comandos útiles:

```bash
docker compose logs -f node
docker compose exec node npm run build
docker compose exec node npm install
```

Puertos del proyecto:

- App Laravel: `http://localhost:8001`
- Vite dev server: `http://localhost:5173`
- PostgreSQL host: `127.0.0.1:5433`
