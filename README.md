# ReparaYa

Plataforma web de gestión de incidencias de reparación. Proyecto del módulo **FP.448 — Desarrollo back-end con PHP, framework MVC y gestor de contenido** (UOC).

**Grupo PHP QUAD-CORE:** Ana Patricia Calabuig · David Vaz Perales · Nadir Neme Rodríguez · Óscar Ruiz Ollobarren.

## Stack

- PHP 8.2 **nativo** (sin Laravel ni frameworks, según restricción del enunciado).
- Mini-framework MVC propio: Router, Controller, Model, Database, Auth.
- MySQL 8.
- Docker Compose (PHP + Apache + MySQL + phpMyAdmin).
- FullCalendar 6 vía CDN en el panel de admin.

## Arranque rápido (local con Docker)

```bash
git clone <URL-DEL-REPO>.git reparaya
cd reparaya
docker compose up -d
# Importar schema (la primera vez):
docker compose exec -T mysql mysql -ureparaya -preparaya reparaya < sql/reparaya.sql
# Regenerar hashes de contraseñas demo:
docker compose exec app php /var/www/html/sql/seed_passwords.php
```

Abrir:

- App: http://localhost:8080
- phpMyAdmin: http://localhost:8081 (usuario `reparaya`, pass `reparaya`)

## Accesos de prueba

| Rol | Email | Contraseña |
|---|---|---|
| Admin | admin@reparaya.local | reparaya123 |
| Técnico | tecnico1@reparaya.local | reparaya123 |
| Cliente | cliente1@reparaya.local | reparaya123 |

## Estructura

```
reparaya/
├── app/
│   ├── Core/        Router, Controller, Model, Database, Auth
│   ├── Models/      Usuario, Tecnico, Especialidad, Incidencia
│   ├── Controllers/ Home, Auth, Cliente, Tecnico, Admin, ...
│   └── Views/       layouts, public, auth, cliente, tecnico, admin
├── config/config.php
├── public/          index.php (front controller) + .htaccess
├── sql/             reparaya.sql + seed_passwords.php
├── docker/          vhost Apache
└── docker-compose.yml
```

## Seguridad

- PDO con sentencias preparadas en todas las queries.
- `password_hash` / `password_verify` (bcrypt).
- Token CSRF en todos los formularios POST.
- Sesiones HttpOnly, SameSite=Lax, `session_regenerate_id` tras login.
- `htmlspecialchars` en todas las salidas.

## Reparto por CRUD

| CRUD | Responsable |
|---|---|
| Usuarios | David Vaz Perales |
| Incidencias (cliente) | Nadir Neme Rodríguez |
| Admin + Calendario | Ana Patricia Calabuig |
| Maestro Técnicos / Especialidades | Óscar Ruiz Ollobarren |
