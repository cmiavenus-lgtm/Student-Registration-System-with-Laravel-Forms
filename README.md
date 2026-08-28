# Student Registration System — College of Information Technology

A complete Laravel web application that replaces paper-based student registration with a digital system. Students can register online, submit personal and academic information, upload a profile picture, and view their registered profile. Built with Laravel, PHP, MySQL, Blade, Laravel Storage, and Tailwind CSS.

**Repository:** `week04-student-registration` (public on GitHub)

---

## Features

- **Digital Registration**: Replace paper forms with an online, responsive registration system
- **Complete Student Profiles**: Store Student ID, names, email, mobile, DOB, gender, program, year level, address, and profile picture
- **Secure File Uploads**: Profile pictures stored in `storage/app/public/profile_pictures` via Laravel Storage (`store('profile_pictures','public')`), accessible via `/storage` URL after `storage:link`
- **Validation**: Full server-side validation with clear error messages and `old()` value preservation
- **Flash Messages**: Success notification “Student registered successfully!” (green, dismissible) and validation errors (red)
- **Responsive UI**: Clean, modern, beginner-friendly interface with Tailwind CSS, works on desktop and mobile
- **Student Listing**: Table (desktop) and cards (mobile) with ID, name, email, program, and View action
- **Profile Page**: Prominent profile picture plus all saved information

## Tech Stack

- Laravel 13.x, PHP 8.3+, MySQL (or SQLite for development), Blade, Tailwind CSS 4, Vite

## Project Structure

```
app/Http/Controllers/StudentController.php   # index, create, store, show
app/Models/Student.php                       # $fillable, casts, full_name accessor
database/migrations/*_create_students_table.php
resources/views/layouts/app.blade.php        # Base layout with Tailwind + flash messages
resources/views/students/index.blade.php     # Listing (table + cards)
resources/views/students/create.blade.php    # Registration form (5 sections)
resources/views/students/show.blade.php      # Profile display
routes/web.php                               # Named routes
```

## Database

**Table:** `students`

| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK |
| student_id | string | unique, required |
| first_name | string(100) | required |
| middle_name | string(100) | nullable |
| last_name | string(100) | required |
| email | string | unique, valid email |
| mobile_number | string | required, numeric |
| date_of_birth | date | required |
| gender | string | required |
| program | string | required (BSIT/BSCS/BSIS/ACT) |
| year_level | string | required (1st-4th Year) |
| address | text | required |
| profile_picture | string | path, required |
| created_at / updated_at | timestamps | |

## Validation Rules

```
student_id      => required|unique:students,student_id
first_name      => required|string|max:100
middle_name     => nullable|string|max:100
last_name       => required|string|max:100
email           => required|email|unique:students,email
mobile_number   => required|numeric
date_of_birth   => required|date
gender          => required
program         => required
year_level      => required
address         => required|string
profile_picture => required|image|mimes:jpg,jpeg,png|max:2048
```

All errors display per-field and in a summary banner; inputs preserve `old()` values; `@csrf` is included.

## Routes

| Method | URI | Name | Action |
|---|---|---|---|
| GET | / | — | redirect → students.index |
| GET | /students | students.index | list |
| GET | /students/create | students.create | form |
| POST | /students | students.store | save + upload |
| GET | /students/{student} | students.show | profile |

## Setup Instructions

### 1. Clone & Install

```bash
git clone https://github.com/<your-username>/week04-student-registration.git
cd week04-student-registration
composer install
npm install
```

### 2. Environment

Copy `.env.example` to `.env`:

```bash
cp .env.example .env
php artisan key:generate
```

**MySQL Configuration** — edit `.env`:

```env
APP_NAME="Student Registration System"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=student_registration
DB_USERNAME=root
DB_PASSWORD=your_password
```

Create the database in MySQL:

```sql
CREATE DATABASE student_registration CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**SQLite alternative for quick testing** (default in `.env.example`):

```env
DB_CONNECTION=sqlite
# DB_HOST, DB_PORT, etc. can remain commented
```

If using SQLite, ensure `database/database.sqlite` exists (it is gitignored, create empty file):

```bash
New-Item -ItemType File -Path database/database.sqlite -Force
```

### 3. Migrations & Storage

```bash
php artisan migrate
php artisan storage:link
```

`storage:link` creates `public/storage` → `storage/app/public`, so uploaded images at `storage/app/public/profile_pictures/*` are accessible via `http://localhost:8000/storage/profile_pictures/*`.

### 4. Frontend

```bash
npm run build   # production
# or
npm run dev     # development with HMR (requires Vite dev server)
```

If Vite manifest is missing, the layout falls back to Tailwind CDN automatically.

### 5. Run

```bash
php artisan serve
# App: http://localhost:8000
# Registration: http://localhost:8000/students/create
```

## Testing the Flow

1. Open `/students/create`, fill all fields, upload JPG/PNG ≤2MB, submit.
2. On success → redirect to `/students/{id}` with green flash “Student registered successfully!” and image displayed via `/storage/...`.
3. Visit `/students` to see table/cards, click View.
4. Test invalid cases: missing fields, duplicate Student ID/email, invalid email, non-numeric mobile, invalid date, invalid image type → red validation summary + per-field errors, old values preserved.

## File Handling & Security

- Uses ` $request->file('profile_picture')->store('profile_pictures','public')`
- Only `profile_picture` path saved to DB; file itself in `storage/app/public`
- Validation `image|mimes:jpg,jpeg,png|max:2048` rejects invalid types and oversize files; `isValid()` check also applied
- Requires `php artisan storage:link` for public URL

## Git History (10+ meaningful commits)

```
chore: initialize Laravel project for Student Registration System
feat: create student migration
feat: create student model
feat: create student controller
feat: define student routes
feat: add flash messages
feat: build registration form
feat: display student listing
feat: display registered student profile
feat: implement validation rules
feat: upload student profile picture
fix: resolve image upload issue
refactor: clean controller methods
```

## License

MIT
