# BinniTaxi

Proyecto Laravel 13 con entorno Docker fijo para desarrollo local.

## Versiones fijadas

- PHP `8.5.0-fpm-bookworm`
- Composer `2.8.12`
- Nginx `1.28.0-alpine`
- PostgreSQL `18.3`
- Redis `8.0-alpine`

## Levantar el proyecto

```bash
docker compose up -d --build
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
docker compose exec app php artisan config:clear
```

La aplicación queda disponible en `http://localhost:8001`.
Vite queda disponible en `http://localhost:5173`.
Horizon queda disponible en `http://localhost:8001/horizon`.

Si cambias variables de entorno o configuración de Docker, recrea el contenedor de la app para que tome los valores nuevos:

```bash
docker compose up -d --force-recreate app nginx
docker compose exec app php artisan config:clear
```

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
- `redis`: Redis `8.0-alpine` expuesto en el puerto `6379`

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
- Redis host: `127.0.0.1:6379`
- Horizon: `http://localhost:8001/horizon`

## Redis, colas y Horizon

El proyecto usa Redis para cache y colas:

```env
QUEUE_CONNECTION=redis
CACHE_STORE=redis
REDIS_CLIENT=predis
REDIS_HOST=127.0.0.1
REDIS_PORT=6379
REDIS_QUEUE=default
```

Dentro del contenedor `app`, Docker sobrescribe `REDIS_HOST=redis` para conectarse al servicio interno de Compose.

Verificar Redis:

```bash
docker compose exec redis redis-cli ping
```

Debe responder:

```text
PONG
```

Iniciar Horizon:

```bash
docker compose exec app php artisan horizon
```

Verificar estado:

```bash
docker compose exec app php artisan horizon:status
```

El dashboard está en `http://localhost:8001/horizon` y requiere login con un usuario que tenga el rol `administrador`.
