# 🧪 UMS Laravel Technical Evaluation — Company Collaborations API

This is a **Laravel 11** project that implements a small REST API and a minimal frontend to manage **company collaborations across countries and cities**.  
It was developed as part of a technical evaluation.

---

## 🚀 Features

- ✅ Laravel 11 REST API using Eloquent ORM  
- ✅ Proper model relationships: Country → City → Company → Collaboration  
- ✅ Clean and efficient Eloquent relationships  
- ✅ Seeders, factories, and migrations for sample data  
- ✅ Simple Blade frontend (Vanilla JS) for filtering and display  
- ✅ Includes setup & troubleshooting guide for local environments like **Laragon** or **XAMPP**

---

## 🧭 API Endpoints

| Method | Endpoint | Description |
|--------|-----------|-------------|
| GET | `/api/collaborations` | List all collaborations grouped by city |
| GET | `/api/collaborations/by-date?date=YYYY-MM-DD` | List collaborations for a specific date |
| GET | `/api/collaborations/company/{id}` | List collaborations for a specific company |
| GET | `/api/companies` | List all companies (used by frontend filter) |

---

## 🧱 Models & Relationships

- **Country** → hasMany `City`
- **City** → belongsTo `Country`; hasMany `Collaboration`
- **Company** → belongsTo `Country`; hasMany `Collaboration` (as `company` and `collaborator`)
- **Collaboration** → belongsTo `Company` (as `company`), `Company` (as `collaborator`), and `City`

---

## 🛠️ Getting Started

### 1️⃣ Clone & Install

```bash
git clone <your-repo-url>
cd ums-app

# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

---

### 2️⃣ Environment & Key

```bash
cp .env.example .env
php artisan key:generate
```

> **Note:** Update your `.env` file with correct database credentials (MySQL, SQLite, etc.)

---

### 3️⃣ Database Migration & Seeding

```bash
php artisan migrate:fresh --seed
```

This will:
- Create all required tables
- Seed sample countries, cities, companies, and 60 collaborations

---

### 4️⃣ Run the Dev Server

```bash
php artisan serve
```

Visit [http://127.0.0.1:8000](http://127.0.0.1:8000) to view the frontend.

---

## 🌐 Simple Frontend

- Located at: `resources/views/collaborations.blade.php`
- Displays collaboration list grouped by city
- Provides filters:
  - by **date**
  - by **company**

All data comes directly from the Laravel API endpoints.

---

## 🧪 Testing (Optional)

Run tests:

```bash
php artisan test
```

Or call endpoints manually:

```bash
curl http://127.0.0.1:8000/api/collaborations
curl "http://127.0.0.1:8000/api/collaborations/by-date?date=2025-01-01"
```

---

## ⚙️ Fixing Common Local Setup Errors

### 🧩 “Failed to open stream: No such file or directory”

If you see:

```
file_put_contents(...storage/framework/sessions...): 
Failed to open stream: No such file or directory
```

Run these commands:

```bash
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
php artisan optimize:clear
```

On **Windows CMD**:

```cmd
mkdir storage\framework\sessions
mkdir storage\framework\views
mkdir storage\framework\cache
php artisan optimize:clear
```

---

### 🔑 Set Correct Permissions (if using Laragon/XAMPP)

Make sure Laravel can write to the following:

- `storage/`
- `bootstrap/cache/`

Run:

```bash
php artisan storage:link
```

Then (for Windows):

1. Right-click the `storage` folder → **Properties → Security → Edit**
2. Give **Modify / Write** access to your user or “Everyone”

---

### 🧼 Clear Laravel Caches

After fixing folders:

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear
```

Then restart your local server:

- **Laragon** → Stop All → Start All  
- **Artisan** → `php artisan serve`

---

## 🗂 Project Structure

```
app/
 ├─ Models/               # Country, City, Company, Collaboration
 ├─ Http/Controllers/     # API endpoints
 ├─ Http/Resources/       # API resource formatting
database/
 ├─ factories/            # Model factories for seeding
 ├─ seeders/              # DatabaseSeeder + SampleDataSeeder
 ├─ migrations/           # Schema definitions
resources/
 ├─ views/                # Blade frontend
routes/
 ├─ api.php               # API routes
 ├─ web.php               # Frontend route
```

---

## 🧹 Housekeeping

- `.gitignore` & `.gitattributes` are included to keep the repo clean  
- `vendor/`, `.env`, compiled assets, and cache files are not tracked  
- Works well on **Laragon**, **XAMPP**, or **Sail**

---

## 📜 License

This project is for **technical evaluation/demo purposes**.  
Feel free to use or adapt its structure for your own Laravel apps.
