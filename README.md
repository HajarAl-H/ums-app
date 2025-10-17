# UMS Collaborations — Laravel API & Simple Frontend

This folder contains **application code** (models, controllers, routes, factories, seeders, migrations, resources, and a Blade page)
to implement the evaluation. Drop these files into a **fresh Laravel 11** project.

## Quickstart

```bash
# 1) Create a fresh Laravel project (requires PHP 8.2+, Composer, Node)
composer create-project laravel/laravel ums-app
cd ums-app

# 2) Copy the files from this package into the project root
#    (Unzip and merge, or move folders one by one.)

# 3) Install & configure .env (DB connection, APP_URL)
cp .env.example .env
php artisan key:generate
# Update DB_... vars in .env

# 4) Install NPM deps (for Vite to serve the Blade page)
npm install
# (Optional) Build assets
npm run build

# 5) Run migrations & seed sample data
php artisan migrate:fresh --seed

# 6) Serve the app
php artisan serve
# Visit http://127.0.0.1:8000 to see the simple UI
# API base: http://127.0.0.1:8000/api
```

## Endpoints

- `GET /api/collaborations` — List all collaborations **grouped by city**. Each record includes city, company, collaborator, date, status.
- `GET /api/collaborations/by-date?date=YYYY-MM-DD` — List collaborations for a specific date.
- `GET /api/collaborations/company/{id}` — List collaborations for a specific company (as initiator **or** collaborator).
- `GET /api/companies` — (Helper) list of companies (used by the simple frontend filter).

## Simple Frontend

- Route: `GET /` — Minimal Blade page that fetches from the API and supports filtering by **date** or **company**.
- This page keeps the frontend **simple but functional** per the notes.

## Notes (from prompt)

- Use migrations, factories, and seeders for sample data — **done**.
- Write clean and efficient Eloquent relationships — **done**.
- Keep the frontend simple but functional — **done**.
- Include steps to run migrations and test endpoints — **done** (see Quickstart).

## Testing with HTTPie / cURL

```bash
http :8000/api/collaborations
http :8000/api/collaborations/by-date date==2025-01-01
http :8000/api/collaborations/company/1
http :8000/api/companies
```
