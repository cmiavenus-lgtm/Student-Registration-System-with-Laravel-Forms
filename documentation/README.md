# Documentation — Student Registration System

## Overview
Digital replacement for paper-based registration for College of Information Technology. Students register online, upload profile picture, receive validation/success notifications, data stored in MySQL, view profile.

## Repository Structure
```
week04-student-registration/
├── app/Http/Controllers/StudentController.php
├── app/Models/Student.php
├── database/migrations/2026_08_28_045848_create_students_table.php
├── resources/views/layouts/app.blade.php
├── resources/views/students/index.blade.php
├── resources/views/students/create.blade.php
├── resources/views/students/show.blade.php
├── routes/web.php
├── storage/app/public/profile_pictures/
├── screenshots/
├── documentation/
└── README.md
```

## Setup (MySQL)
See `README.md` at root for full instructions. Quick:
```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
# Edit .env: DB_CONNECTION=mysql, DB_HOST=127.0.0.1, DB_PORT=3306, DB_DATABASE=student_registration, DB_USERNAME=root, DB_PASSWORD=
php artisan migrate
php artisan storage:link
npm run build
php artisan serve
```

## Validation Rules
As implemented in `StudentController.php:33`:
- `student_id => required|unique:students,student_id`
- `first_name => required|string|max:100`
- `middle_name => nullable|string|max:100`
- `last_name => required|string|max:100`
- `email => required|email|unique:students,email`
- `mobile_number => required|numeric`
- `date_of_birth => required|date`
- `gender => required`
- `program => required`
- `year_level => required`
- `address => required|string`
- `profile_picture => required|image|mimes:jpg,jpeg,png|max:2048`

## Features
- Green professional theme with responsive sidebar
- Flash messages (green success, red errors)
- Old input preservation, CSRF protection
- 15 seeded students, Academic Year 2026-2027
- Storage via `store('profile_pictures','public')` and `public/storage` link
