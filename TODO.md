# TODO - Backend Servicio de Mototaxis

> **Stack:** Laravel 12 · Twilio WhatsApp · LLM (OpenAI/Anthropic) · Sanctum · FCM · Redis · Filament
> **Cliente:** WhatsApp · **Mototaxista:** App Flutter (login con Google) · **Admin:** Panel web
> **Estimación:** 22-30 días de trabajo enfocado (6-8 semanas calendario)

---

## Decisiones técnicas tomadas

- [ ] LLM: OpenAI GPT-4o-mini o Claude Haiku con function calling
- [ ] Actualización GPS: 15s disponible / 8s en viaje · `distanceFilter` 20m
- [ ] Auth API: **Google Sign-In + Laravel Sanctum** (token de sesión emitido por backend tras validar idToken)
- [ ] Push: Firebase Cloud Messaging (FCM)
- [ ] Queues: Redis + Horizon
- [ ] Timeout aceptación mototaxista: 20 segundos
- [ ] Panel admin: Filament v3
- [ ] Código de invitación: obligatorio en el primer login con Google

---

## FASE 0 — Setup y Fundamentos (1-2 días)

- [ ] Crear proyecto Laravel 12 con `composer create-project laravel/laravel`
- [ ] Configurar `.env`: BD, Redis, timezone, locale `es`
- [ ] Instalar y configurar Laravel Sanctum
- [ ] Instalar Laravel Horizon
- [ ] Configurar Redis para cache y queues
- [ ] Setup repo Git con `.gitignore` y branches `main`/`develop`
- [ ] Configurar Laravel Pint
- [ ] Crear estructura: `Services/`, `Actions/`, `DTOs/`, `Enums/`
- [ ] Configurar logging channels (twilio, llm, rides, jobs, auth)
- [ ] Crear cuenta Twilio + número WhatsApp sandbox
- [ ] Crear cuenta OpenAI / Anthropic
- [ ] Crear proyecto Firebase + descargar credenciales FCM
- [ ] **Crear proyecto en Google Cloud Console**
- [ ] **Configurar OAuth Consent Screen (modo External)**
- [ ] **Crear credenciales OAuth 2.0: Android Client ID, iOS Client ID y Web Client ID**
- [ ] **Anotar Web Client ID — es el `audience` que validará el backend**

---

## FASE 1 — Modelo de Datos y Migraciones (1-2 días)

- [ ] Migración `customers`: id, phone (único E.164), name, created_at, last_active_at
- [ ] Migración `drivers`: id, **google_id (único, nullable)**, **email (único)**, **avatar_url (nullable)**, name, phone, license_plate, vehicle_info (json), status (enum), current_lat, current_lng, location_updated_at, rating_avg, total_rides, fcm_token, last_login_at
- [ ] Migración `invitation_codes`: code, used_by (driver_id, nullable), used_at, expires_at, created_at
- [ ] Migración `rides`: id, customer_id, driver_id (nullable), pickup_lat/lng, pickup_address, destination_text (nullable), status (enum), assignment_attempts, requested_at, accepted_at, started_at, completed_at, cancelled_at, cancelled_by
- [ ] Migración `ride_assignments`: ride_id, driver_id, sent_at, responded_at, response
- [ ] Migración `conversation_states`: customer_id, state (enum), context (json), updated_at
- [ ] Migración `messages_log`: customer_id, direction, body, media_url, twilio_sid, created_at
- [ ] Migración `driver_location_history` (opcional)
- [ ] Migración `admin_users` (separado, login con email/password)
- [ ] Crear Models con relaciones, casts y scopes
- [ ] Crear Enums: `RideStatus`, `DriverStatus`, `ConversationState`, `MessageDirection`
- [ ] Seeders: admin user + código de invitación de prueba
- [ ] Factories para testing
- [ ] Índices en BD: `customers.phone`, `drivers.google_id`, `drivers.email`, `drivers.status`, `drivers.current_lat/lng`, `rides.status`, `rides.customer_id`

---

## FASE 2 — Integración Twilio WhatsApp (2-3 días)

- [ ] Instalar `twilio/sdk`
- [ ] Endpoint `POST /api/webhooks/twilio/whatsapp` con validación X-Twilio-Signature
- [ ] `TwilioService`: `sendMessage()`, `sendLocationMessage()`, `validateWebhook()`
- [ ] Parser de payload Twilio: texto, ubicación, media
- [ ] Guardado en `MessageLog` (in/out)
- [ ] Identificación/creación automática de `Customer` por teléfono
- [ ] Job `ProcessIncomingMessageJob` (procesamiento async)
- [ ] Manejo de ventana de 24h de WhatsApp Business API
- [ ] Testing manual con ngrok + sandbox Twilio

---

## FASE 3 — Motor de Conversación con LLM (3-4 días)

- [ ] Instalar SDK del LLM (`openai-php/laravel` o `anthropic-php`)
- [ ] Diseñar máquina de estados: `idle`, `awaiting_location`, `awaiting_confirmation`, `searching_driver`, `driver_assigned`, `in_ride`
- [ ] `ConversationStateService` (read/write estado en BD)
- [ ] `LLMService` con prompt system del rol del bot
- [ ] Function calling / tools:
    - [ ] `request_ride(pickup_location?, destination?)`
    - [ ] `cancel_current_ride()`
    - [ ] `check_ride_status()`
    - [ ] `provide_help()`
    - [ ] `unknown_request()`
- [ ] `ConversationOrchestrator`: mensaje → estado → LLM → acción
- [ ] Shortcut: si llega ubicación de WhatsApp y estado lo espera, saltar LLM
- [ ] Plantillas de respuestas en español (lang files)
- [ ] Rate limiting por teléfono (ej. 30 msg/hora)
- [ ] Logging detallado de prompts/respuestas LLM
- [ ] Validar que el cliente no tenga ride activo antes de crear otro

---

## FASE 4 — Sistema de Asignación de Mototaxistas (3-4 días)

- [ ] `DriverMatchingService::findNearestAvailableDrivers(lat, lng, radius, limit)`
- [ ] Query con fórmula Haversine en SQL
- [ ] Filtros: `status=available`, `location_updated_at` < 60s, sin ride activo
- [ ] `RideAssignmentService` con flujo de 5 candidatos
- [ ] Job `AssignDriverJob`
- [ ] Job `DriverResponseTimeoutJob` con `delay(20)`
- [ ] Endpoint `POST /api/driver/rides/{id}/accept`
- [ ] Endpoint `POST /api/driver/rides/{id}/reject`
- [ ] Lock con Redis (`Cache::lock`) para evitar race condition
- [ ] Notificar a cliente vía WhatsApp con datos del mototaxista
- [ ] Notificar a mototaxista con ubicación del cliente
- [ ] Caso "no hay mototaxistas": expandir radio o marcar `no_drivers`
- [ ] Mensaje al cliente con opción de reintentar

---

## FASE 5 — API para App Flutter (3-4 días)

### Auth con Google Sign-In
- [ ] Instalar `google/apiclient` (`composer require google/apiclient`)
- [ ] Crear `GoogleAuthService` con método `verifyIdToken(string $idToken): array`
- [ ] Configurar `services.php` con `google.client_id` (Web Client ID) y `google.allowed_audiences` (array con Android, iOS y Web Client IDs)
- [ ] Validar `aud`, `iss` (`accounts.google.com` o `https://accounts.google.com`), `exp` y `email_verified`
- [ ] **Endpoint `POST /api/auth/google`** — body: `{ id_token, invitation_code? }`
    - [ ] Verificar `id_token` con Google
    - [ ] Si existe `google_id` → login, generar token Sanctum, retornar driver
    - [ ] Si existe `email` sin `google_id` → vincular cuenta (setear `google_id`)
    - [ ] Si no existe → requiere `invitation_code` válido para crear `Driver`
    - [ ] Validar y consumir `invitation_code` (marcar `used_at` y `used_by`)
    - [ ] Crear driver con datos de Google (name, email, avatar_url, google_id)
    - [ ] Generar token Sanctum y retornar
- [ ] **Endpoint `POST /api/auth/logout`** — revoca token actual
- [ ] **Endpoint `DELETE /api/auth/account`** — opcional, eliminar cuenta (cumplimiento Google Play)
- [ ] Manejo de errores específicos:
    - [ ] `id_token` inválido / expirado → 401
    - [ ] `email_verified=false` → 403
    - [ ] Código de invitación inválido / usado / expirado → 422
    - [ ] Cuenta suspendida → 403
- [ ] Form Request `GoogleAuthRequest` con validación
- [ ] Resource `DriverResource` (no exponer `google_id` ni datos sensibles)
- [ ] Tests del flujo completo (mock de `GoogleAuthService`)

### Perfil
- [ ] `GET /api/driver/me`
- [ ] `PATCH /api/driver/me` (solo campos editables: phone, license_plate, vehicle_info)
- [ ] `POST /api/driver/status` (available/offline)
- [ ] `POST /api/driver/fcm-token`

### Ubicación
- [ ] `POST /api/driver/location` (throttle 1/5s)

### Viajes
- [ ] `GET /api/driver/rides/current`
- [ ] `POST /api/driver/rides/{id}/accept`
- [ ] `POST /api/driver/rides/{id}/reject`
- [ ] `POST /api/driver/rides/{id}/start`
- [ ] `POST /api/driver/rides/{id}/complete`
- [ ] `GET /api/driver/rides/history` (paginado)

### Generales
- [ ] Form Requests para validación
- [ ] API Resources para respuestas
- [ ] Middleware `EnsureDriverNotSuspended`
- [ ] Middleware `EnsureProfileComplete` (phone y license_plate obligatorios después del primer login)

---

## FASE 6 — Notificaciones Push FCM (1-2 días)

- [ ] Instalar `laravel-notification-channels/fcm` o `kreait/laravel-firebase`
- [ ] `NewRideRequestNotification`
- [ ] `RideCancelledByCustomerNotification`
- [ ] `RideAssignmentTimeoutNotification`
- [ ] Payload con `data` (no solo `notification`)
- [ ] Retry en caso de fallo FCM
- [ ] Limpieza de token inválido

---

## FASE 7 — Flujo de Cancelación (1 día)

- [ ] Detectar intent "cancelar" en LLM
- [ ] Cancelación cliente vía WhatsApp → notifica mototaxista por FCM
- [ ] Endpoint `POST /api/driver/rides/{id}/cancel` (con razón)
- [ ] Detener jobs de asignación pendientes si se cancela durante búsqueda
- [ ] Mensaje de confirmación al cliente

---

## FASE 8 — Panel de Administración (2-3 días)

- [ ] Instalar Filament v3
- [ ] Resource: Drivers (listar, ver, suspender, **ver email de Google vinculado**, generar invitaciones)
- [ ] Resource: Customers (listar, ver historial)
- [ ] Resource: Rides (filtros por estado/fecha, detalle con mapa)
- [ ] Resource: InvitationCodes (generar, ver usadas/disponibles)
- [ ] Resource: MessagesLog (solo lectura, para debugging)
- [ ] Dashboard widgets: viajes hoy, completados/cancelados, mototaxistas activos, viajes por hora
- [ ] Auth con guard `web` (sesión, email/password — independiente de Google)

---

## FASE 9 — Testing (2-3 días, idealmente en paralelo)

- [ ] Unit: `DriverMatchingService` (Haversine + filtros)
- [ ] Unit: `ConversationOrchestrator` con LLM mockeado
- [ ] **Unit: `GoogleAuthService` con respuesta mockeada de Google**
- [ ] **Feature: flujo completo de registro con Google + código de invitación**
- [ ] **Feature: flujo de login con Google de usuario existente**
- [ ] **Feature: rechazo cuando `email_verified=false`**
- [ ] **Feature: rechazo cuando código de invitación inválido/usado**
- [ ] Feature: endpoints API driver (con token Sanctum)
- [ ] Feature: webhook Twilio con payload simulado
- [ ] Integration: flujo completo de ride (request → assign → accept → complete)
- [ ] Test: caso "no hay mototaxistas"
- [ ] Test: timeout y reasignación
- [ ] Test: cancelación en cada estado

---

## FASE 10 — Deploy y Operación (1-2 días)

- [ ] Aprovisionar VPS (Hetzner / DigitalOcean / Vultr)
- [ ] Configurar Laravel Forge
- [ ] Dominio + SSL Let's Encrypt
- [ ] Variables de entorno en producción (incluir `GOOGLE_CLIENT_ID` y audiences)
- [ ] Supervisor para queue workers (Forge)
- [ ] Laravel Scheduler en cron (Forge)
- [ ] Backups automáticos de BD
- [ ] Sentry o Bugsnag para errores
- [ ] Telescope solo en staging
- [ ] Scheduled job: marcar drivers `offline` si `location_updated_at` > 2 min
- [ ] Scheduled job: limpiar `conversation_states` viejos
- [ ] Scheduled job: limpiar `messages_log` > 90 días
- [ ] **Configurar OAuth Consent Screen en modo Producción (no Testing) en Google Cloud Console**
- [ ] **Verificar SHA-1 (Android) y Bundle ID (iOS) registrados en Firebase / Google Cloud**
- [ ] **Trámite WhatsApp Business API con Meta (EMPEZAR TEMPRANO)**
- [ ] Documentar API con Scribe

---

## FASE 11 — Pulido pre-lanzamiento (1-2 días)

- [ ] Revisar mensajes en español (tono y claridad)
- [ ] Manejo de errores: Twilio caído, LLM caído, Google caído → fallbacks amables
- [ ] Circuit breaker: si LLM falla → menú de opciones predefinidas
- [ ] Revisar índices de BD
- [ ] Revisar costos LLM y optimizar prompt
- [ ] Pruebas con números reales antes de invitar mototaxistas
- [ ] Pruebas del login con cuentas de Google reales en dispositivos físicos (Android e iOS)

---

## Notas y Pendientes Generales

- [ ] Decidir si usar MySQL o PostgreSQL (PostgreSQL + PostGIS sería ideal para geoespacial)
- [ ] Definir radio inicial de búsqueda de mototaxistas (sugerencia: 2 km, expandir a 5 km)
- [ ] Definir mensajes exactos de bienvenida y onboarding
- [ ] Definir política de retención de datos
- [ ] **Definir política de privacidad pública (requisito de Google para OAuth en producción)**
- [ ] Generar términos y condiciones para mototaxistas

---

## Riesgos identificados

> ⚠️ **Trámite de WhatsApp Business API con Meta** puede demorar días/semanas — iniciar al tener MVP en sandbox
> ⚠️ **Verificación OAuth en Google** — para scopes básicos (`email`, `profile`) basta publicar la app; verificar requisitos actuales si se añaden scopes sensibles
> ⚠️ **Costos del LLM** — monitorear desde día 1, optimizar prompt si escala
> ⚠️ **Race conditions** en asignación simultánea — los locks de Redis son críticos
> ⚠️ **Client IDs múltiples** — Android, iOS y Web usan client IDs distintos pero todos deben validarse contra el mismo backend como `audience` válido
