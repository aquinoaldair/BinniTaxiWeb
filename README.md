# BinniTaxi

Proyecto Laravel 13 con entorno Docker fijo para desarrollo local.

## Versiones fijadas

- PHP `8.5.0-fpm-bookworm`
- Composer `2.8.12`
- Nginx `1.28.0-alpine`
- MariaDB `10.6.23`

## Levantar el proyecto

```bash
docker compose up -d --build
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
```

La aplicación queda disponible en `http://localhost:8001`.

## Servicios

- `app`: contenedor PHP-FPM con las extensiones mínimas para Laravel
- `nginx`: servidor web expuesto en el puerto `8001`
- `db`: MariaDB `10.6.23` expuesta en el puerto `3307`

## Base de datos

Las credenciales por defecto dentro de Docker son:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=binnitaxi
DB_USERNAME=binnitaxi
DB_PASSWORD=binnitaxi
```

Para conectarte desde el host, por ejemplo desde PhpStorm:

```env
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=binnitaxi
DB_USERNAME=binnitaxi
DB_PASSWORD=binnitaxi
```
