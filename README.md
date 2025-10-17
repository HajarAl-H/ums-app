# 🧪 UMS Laravel Technical Evaluation — Company Collaborations API

This is a **Laravel 11** project that implements a small REST API and a minimal frontend to manage **company collaborations across countries and cities**.  
It was developed as part of a technical evaluation.

---

## 🚀 Features

- ✅ Laravel 11 API using Eloquent ORM  
- ✅ Proper model relationships: Country → City → Company → Collaboration  
- ✅ Clean and efficient API endpoints  
- ✅ Seeders, factories, and migrations for sample data  
- ✅ Simple frontend (Blade + Vanilla JS) for quick filtering and viewing  
- ✅ Fully container-ready and git-clean (via `.gitignore` / `.gitattributes`)

---

## 🧭 API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/api/collaborations` | List all collaborations grouped by city |
| GET | `/api/collaborations/by-date?date=YYYY-MM-DD` | List collaborations for a specific date |
| GET | `/api/collaborations/company/{id}` | List collaborations for a specific company |
| GET | `/api/companies` | List all companies (used by frontend filter) |

---

## 🧱 Models & Relationships

- **Country**  
  - hasMany → `City`

- **City**  
  - belongsTo → `Country`  
  - hasMany → `Collaboration`

- **Company**  
  - belongsTo → `Country`  
  - hasMany → `Collaboration` (as `company`)  
  - hasMany → `Collaboration` (as `collaborator`)

- **Collaboration**  
  - belongsTo → `Company` (as `company`)  
  - belongsTo → `Company` (as `collaborator`)  
  - belongsTo → `City`

---

## 🛠️ Getting Started

### 1️⃣ Clone & Install

```bash
git clone https://github.com/HajarAl-H/ums-app
cd ums-app

composer install
npm install
```

---

### 2️⃣ Environment & Key

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` to set up your **database** connection (MySQL, SQLite, etc.).

---

### 3️⃣ Database Migration & Seeding

```bash
php artisan migrate:fresh --seed
```

This will:
- Create the schema
- Seed sample countries, cities, companies, and 60 random collaborations

---

### 4️⃣ Run the Dev Server

```bash
php artisan serve
```

Visit [http://127.0.0.1:8000](http://127.0.0.1:8000) to open the frontend.

---

## 🌐 Simple Frontend

The Blade file at `resources/views/collaborations.blade.php` provides:

- A company dropdown (auto-filled from `/api/companies`)
- A date filter
- Collaboration lists rendered dynamically

You can filter by date or company, or view all collaborations grouped by city.

---

## 🧪 Testing (Optional)

Run Laravel's test suite:

```bash
php artisan test
```

You can also hit endpoints with curl or Postman:

```bash
curl http://127.0.0.1:8000/api/collaborations
curl "http://127.0.0.1:8000/api/collaborations/by-date?date=2025-01-01"
```

---

## 📝 Project Structure

```
app/
 ├─ Models/               # Country, City, Company, Collaboration
 ├─ Http/Controllers/     # API endpoints
 ├─ Http/Resources/       # API resource formatting
database/
 ├─ factories/            # Model factories for seeding
 ├─ seeders/              # DatabaseSeeder + SampleDataSeeder
 ├─ migrations/           # Schema
resources/
 ├─ views/                # Blade frontend
routes/
 ├─ api.php               # API routes
 ├─ web.php               # Frontend route
```

---

## 🧼 Housekeeping

- `.gitignore` & `.gitattributes` are included to keep the repo clean.
- No `vendor/`, `.env`, caches, or compiled assets are tracked.
- Compatible with **Laravel Sail** / Docker if needed.


