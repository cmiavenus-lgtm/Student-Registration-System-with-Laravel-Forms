# Student Registration System — College of Information Technology

A complete Laravel web application that replaces paper-based student registration with a digital system. Students can register online, submit personal and academic information, upload a profile picture, and view their registered profile. Built with Laravel, PHP, MySQL, Blade, Laravel Storage, and Tailwind CSS.

**Repository:** `week04-student-registration` (public on GitHub)

---

## Table of Contents

1. [Introduction](#1-introduction)
2. [Objectives](#2-objectives)
3. [Features](#3-features)
4. [Tech Stack](#4-tech-stack)
5. [Project Structure](#5-project-structure)
6. [Laravel Request Lifecycle](#6-laravel-request-lifecycle)
7. [Routes](#7-routes)
8. [Database Design](#8-database-design)
9. [Validation Rules](#9-validation-rules)
10. [Setup Instructions](#10-setup-instructions)
11. [Testing the Flow](#11-testing-the-flow)
12. [Screenshots](#12-screenshots)
13. [Problems Encountered & Solutions](#13-problems-encountered--solutions)
14. [Reflection](#14-reflection)
15. [References](#15-references)
16. [License](#16-license)

---

## 1. Introduction

### Purpose of a Student Registration System

A Student Registration System is a fundamental component in educational institutions that streamlines the process of enrolling students into academic programs. Traditional paper-based registration systems are prone to data entry errors, loss of records, and inefficiencies in retrieving student information. A digital registration system addresses these challenges by providing a centralized, accessible, and secure platform for managing student data.

This system allows students to fill out registration forms online, submit their personal and academic information, and upload required documents such as profile pictures. The data is then stored securely in a database, enabling administrators and staff to easily access and manage student records.

### Importance of Data Validation

Data validation is a critical aspect of any registration system. It ensures that the information submitted by users is accurate, complete, and in the correct format before it is stored in the database. Without proper validation, the system could accept invalid or malicious data, leading to:

- **Data Integrity Issues**: Duplicate records, missing fields, or incorrectly formatted data
- **Security Vulnerabilities**: SQL injection, file upload attacks, or cross-site scripting
- **Application Errors**: Crashes or unexpected behavior due to invalid input

Server-side validation acts as the primary line of defense, ensuring that all data is validated before being processed, regardless of client-side validation rules.

### Role of Registration Systems in Enterprise Applications

Registration systems are ubiquitous in enterprise software. They serve as the entry point for user onboarding in:

- **Educational Institutions**: Student enrollment, course registration
- **Healthcare**: Patient registration, appointment scheduling
- **Corporate**: Employee onboarding, customer registration
- **Government**: Citizen services, voter registration

A well-designed registration system demonstrates key software engineering principles: form handling, file upload management, database operations, user interface design, and security best practices.

---

## 2. Objectives

By completing this project, the following learning objectives have been accomplished:

1. **Understand the Laravel Framework**: Gain hands-on experience with Laravel's MVC architecture, routing, controllers, models, and Blade templating engine.

2. **Implement Form Handling**: Learn how to create responsive registration forms with proper field grouping, labels, and input types using Tailwind CSS.

3. **Apply Server-Side Validation**: Implement comprehensive validation rules including required fields, unique constraints, email validation, numeric validation, image validation, and file size restrictions.

4. **Master File Upload Handling**: Understand Laravel's file storage system, including secure file uploads, storage links, and path management.

5. **Work with Flash Messages**: Implement success and error notifications that provide immediate feedback to users after form submission.

6. **Design Database Schemas**: Create well-structured database tables with appropriate data types, primary keys, and constraints using Laravel migrations.

7. **Build Responsive Interfaces**: Develop mobile-friendly user interfaces that adapt to different screen sizes using Tailwind CSS.

8. **Apply MVC Architecture**: Separate concerns by organizing code into Models, Views, and Controllers following Laravel best practices.

9. **Version Control with Git**: Practice meaningful commit messages and maintain a clean Git history throughout the development process.

10. **Document Software Projects**: Create comprehensive documentation including setup instructions, validation rules, database design, and project reflection.

---

## 3. Features

- **Digital Registration**: Replace paper forms with an online, responsive registration system
- **Complete Student Profiles**: Store Student ID, names, email, mobile, DOB, gender, program, year level, address, and profile picture
- **Secure File Uploads**: Profile pictures stored in `storage/app/public/profile_pictures` via Laravel Storage (`store('profile_pictures','public')`), accessible via `/storage` URL after `storage:link`
- **Validation**: Full server-side validation with clear error messages and `old()` value preservation
- **Flash Messages**: Success notification "Student registered successfully!" (green, dismissible) and validation errors (red)
- **Responsive UI**: Clean, modern, beginner-friendly interface with Tailwind CSS, works on desktop and mobile
- **Student Listing**: Table (desktop) and cards (mobile) with ID, name, email, program, and View action
- **Profile Page**: Prominent profile picture plus all saved information
- **Professional Green Theme**: Sidebar layout with gradient green styling

---

## 4. Tech Stack

- **Backend**: Laravel 13.x, PHP 8.3+
- **Database**: MySQL (or SQLite for development)
- **Frontend**: Blade templating, Tailwind CSS 4, Vite
- **Version Control**: Git, GitHub
- **Development Environment**: XAMPP (Apache + MariaDB)

---

## 5. Project Structure

```
week04-student-registration/
│
├── app/
│   └── Http/
│       └── Controllers/
│           └── StudentController.php    # index, create, store, show
│   └── Models/
│       └── Student.php                  # $fillable, casts, full_name accessor
│
├── database/
│   └── migrations/
│       └── *_create_students_table.php  # Database schema
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php            # Base layout with sidebar
│       └── students/
│           ├── index.blade.php          # Student listing (table + cards)
│           ├── create.blade.php         # Registration form (5 sections)
│           └── show.blade.php           # Student profile display
│
├── routes/
│   └── web.php                          # Route definitions
│
├── storage/
│   └── app/
│       └── public/
│           └── profile_pictures/        # Uploaded images
│
├── screenshots/                         # Application screenshots
├── documentation/                       # Diagrams and documentation
│
└── README.md                            # Project documentation
```

---

## 6. Laravel Request Lifecycle

Understanding the Laravel request lifecycle is essential for building robust web applications. Here is how a registration request moves through the system:

### Request Flow Diagram

```
┌─────────────┐
│   Browser   │  User fills out registration form
│   (Client)  │  and clicks "Register Student"
└──────┬──────┘
       │
       ▼
┌─────────────┐
│   Route     │  POST /students → StudentController@store
│  (web.php)  │  Matches HTTP method + URI to controller
└──────┬──────┘
       │
       ▼
┌─────────────┐
│ Controller  │  StudentController::store() receives
│ (Controller)│  Request object, calls validate()
└──────┬──────┘
       │
       ▼
┌─────────────┐
│ Validation  │  Laravel validates all fields against
│  (Rules)    │  defined rules (required, unique, email, etc.)
└──────┬──────┘
       │
   ┌───┴───┐
   │Valid? │
   └───┬───┘
  Yes  │  No
   │   └──→ Return back() with errors + old() input
   ▼
┌─────────────┐
│   Model     │  Student::create($validated) creates
│  (Eloquent) │  new record with mass assignment
└──────┬──────┘
       │
       ▼
┌─────────────┐
│  Database   │  INSERT INTO students (...) VALUES (...)
│  (MySQL)    │  Data persisted to MySQL storage
└──────┬──────┘
       │
       ▼
┌─────────────┐
│  Response   │  Redirect to /students/{id} with
│  (Redirect) │  flash message "Student registered successfully!"
└──────┬──────┘
       │
       ▼
┌─────────────┐
│   Browser   │  Displays student profile page
│   (Client)  │  with success notification
└─────────────┘
```

### Lifecycle Steps Explained

1. **Browser (Client)**: The user fills out the registration form with personal, contact, academic, and address information, selects a profile picture, and submits the form.

2. **Route**: Laravel's router matches the `POST /students` request to `StudentController@store` method, as defined in `routes/web.php`.

3. **Controller**: The `store()` method receives the `Request` object and calls `$request->validate()` with all validation rules.

4. **Validation**: Laravel checks each field against the defined rules. If validation fails, it automatically redirects back to the form with error messages and preserves the user's input using `old()`.

5. **Model**: If validation passes, `Student::create($validated)` uses Eloquent's mass assignment to create a new Student record. The model's `$fillable` array ensures only allowed fields are saved.

6. **Database**: The INSERT query is executed against the MySQL database, storing all student data including the profile picture path.

7. **Response**: The controller redirects to the student's profile page with a flash success message, which is displayed to the user.

---

## 7. Routes

| Method | URI | Name | Action | Description |
|--------|-----|------|--------|-------------|
| GET | / | — | redirect → students.index | Home redirects to student list |
| GET | /students | students.index | StudentController@index | Display all registered students |
| GET | /students/create | students.create | StudentController@create | Show registration form |
| POST | /students | students.store | StudentController@store | Validate and save new student |
| GET | /students/{student} | students.show | StudentController@show | Display student profile |

---

## 8. Database Design

### Entity Relationship Diagram (ERD)

```
┌─────────────────────────────────────┐
│              students               │
├─────────────────────────────────────┤
│ id              BIGINT (PK)         │  Auto-increment primary key
│ student_id      VARCHAR (UNIQUE)    │  Unique student identifier
│ first_name      VARCHAR(100)        │  Required
│ middle_name     VARCHAR(100)        │  Optional (nullable)
│ last_name       VARCHAR(100)        │  Required
│ email           VARCHAR (UNIQUE)    │  Unique, valid email
│ mobile_number   VARCHAR(11)         │  Must start with 09, 11 digits
│ date_of_birth   DATE                │  Required
│ gender          VARCHAR             │  Male/Female/Other
│ program         VARCHAR             │  BSIT/BSCS/BSIS/ACT
│ year_level      VARCHAR             │  1st-4th Year
│ address         TEXT                │  Full address
│ profile_picture VARCHAR             │  Path to uploaded image
│ created_at      TIMESTAMP           │  Record creation time
│ updated_at      TIMESTAMP           │  Last update time
└─────────────────────────────────────┘
```

### Table Structure

**Table Name:** `students`

| Column | Data Type | Constraints | Description |
|--------|-----------|-------------|-------------|
| id | BIGINT UNSIGNED | PRIMARY KEY, AUTO_INCREMENT | Unique record identifier |
| student_id | VARCHAR(255) | UNIQUE, NOT NULL | Student identification number |
| first_name | VARCHAR(100) | NOT NULL | Student's first name |
| middle_name | VARCHAR(100) | NULLABLE | Student's middle name (optional) |
| last_name | VARCHAR(100) | NOT NULL | Student's last name |
| email | VARCHAR(255) | UNIQUE, NOT NULL | Student's email address |
| mobile_number | VARCHAR(11) | NOT NULL | 11-digit mobile starting with 09 |
| date_of_birth | DATE | NOT NULL | Student's date of birth |
| gender | VARCHAR(255) | NOT NULL | Male, Female, or Other |
| program | VARCHAR(255) | NOT NULL | BSIT, BSCS, BSIS, or ACT |
| year_level | VARCHAR(255) | NOT NULL | 1st, 2nd, 3rd, or 4th Year |
| address | TEXT | NOT NULL | Complete address |
| profile_picture | VARCHAR(255) | NOT NULL | Path to uploaded image |
| created_at | TIMESTAMP | NULLABLE | Auto-set on creation |
| updated_at | TIMESTAMP | NULLABLE | Auto-set on update |

### Data Types

- **VARCHAR**: Variable-length strings for names, emails, IDs (performance optimized)
- **TEXT**: Longer text for addresses (no length limit)
- **DATE**: Stores date of birth without time component
- **TIMESTAMP**: Automatic tracking of record creation and updates

### Primary Key

The `id` column serves as the primary key, using Laravel's `bigIncrements` (BIGINT AUTO_INCREMENT) for unique record identification.

### Constraints

- **UNIQUE** on `student_id`: Prevents duplicate student registrations
- **UNIQUE** on `email`: Ensures each student has a unique email address
- **NOT NULL**: Required fields cannot be empty
- **NULLABLE**: `middle_name` is optional

---

## 9. Validation Rules

### Implemented Rules

```php
$validated = $request->validate([
    'student_id'      => 'required|unique:students,student_id',
    'first_name'      => 'required|string|max:100',
    'middle_name'     => 'nullable|string|max:100',
    'last_name'       => 'required|string|max:100',
    'email'           => 'required|email|unique:students,email',
    'mobile_number'   => ['required', 'regex:/^09[0-9]{9}$/', 'digits:11'],
    'date_of_birth'   => 'required|date',
    'gender'          => 'required',
    'program'         => 'required',
    'year_level'      => 'required',
    'address'         => 'required|string',
    'profile_picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
]);
```

### Validation Rules Explained

#### Required Fields
All fields except `middle_name` are required. This ensures that the database receives complete student records and prevents incomplete registrations from being saved.

**Why important**: Missing data can cause issues in reporting, communication, and academic tracking.

#### Unique Constraints
- `student_id => unique:students,student_id`: Prevents two students from having the same student ID
- `email => unique:students,email`: Prevents duplicate email registrations

**Why important**: Duplicate records create data integrity issues, make it difficult to identify students, and can cause errors in academic systems.

#### Email Validation
`email => email`: Ensures the submitted value is a valid email address format.

**Why important**: Invalid emails prevent communication with students and indicate potential data entry errors.

#### Numeric Validation
`mobile_number => ['required', 'regex:/^09[0-9]{9}$/', 'digits:11']`: Ensures the mobile number is exactly 11 digits and starts with "09".

**Why important**: Philippine mobile numbers follow the 09XX format. Invalid numbers cannot receive SMS notifications.

#### Image Validation
`profile_picture => 'required|image|mimes:jpg,jpeg,png|max:2048'`:
- `image`: Must be an image file
- `mimes:jpg,jpeg,png`: Only JPG and PNG formats allowed
- `max:2048`: Maximum file size of 2MB

**Why important**: Restricting file types prevents malicious file uploads. Size limits prevent storage abuse and ensure fast page loads.

### Custom Error Messages

```php
'mobile_number.regex' => 'Mobile number must be 11 digits starting with 09.',
'mobile_number.digits' => 'Mobile number must be exactly 11 digits.',
```

Custom messages provide clear, user-friendly guidance when validation fails.

---

## 10. Setup Instructions

### Prerequisites

- PHP 8.3 or higher
- Composer
- Node.js and npm
- MySQL (via XAMPP) or SQLite
- Git

### 1. Clone & Install

```bash
git clone https://github.com/<your-username>/week04-student-registration.git
cd week04-student-registration
composer install
npm install
```

### 2. Environment Configuration

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
DB_PASSWORD=
```

Create the database in MySQL:

```sql
CREATE DATABASE student_registration CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

**SQLite alternative** (for quick testing):

```env
DB_CONNECTION=sqlite
```

### 3. Migrations & Storage

```bash
php artisan migrate
php artisan storage:link
```

`storage:link` creates a symbolic link from `public/storage` to `storage/app/public`, making uploaded images accessible via the web.

### 4. Frontend Build

```bash
npm run build    # production
npm run dev      # development with HMR
```

### 5. Run the Application

```bash
php artisan serve
# Application: http://localhost:8000
# Registration: http://localhost:8000/students/create
# Student List: http://localhost:8000/students
```

---

## 11. Testing the Flow

### Successful Registration

1. Open `http://localhost:8000/students/create`
2. Fill in all required fields:
   - Student ID: `2024-1016`
   - First Name: `Juan`
   - Last Name: `Dela Cruz`
   - Email: `juan.delacruz@example.com`
   - Mobile Number: `09123456789`
   - Date of Birth: `2002-01-15`
   - Gender: `Male`
   - Program: `BSIT`
   - Year Level: `3rd Year`
   - Address: `123 Sample St., Victoria, Laguna`
   - Profile Picture: Upload a JPG/PNG file (max 2MB)
3. Click "Register Student"
4. Expected: Redirect to `/students/16` with green flash "Student registered successfully!"

### Validation Errors

Test invalid submissions to verify validation:
- Leave required fields empty → "required" errors
- Enter duplicate student ID → "unique" error
- Enter invalid email format → "email" error
- Enter non-numeric mobile number → "numeric" error
- Upload a .txt file → "image" error
- Upload a 5MB image → "max:2048" error

### Student Listing

Visit `/students` to see:
- Table view on desktop with columns: Student ID, Name, Email, Program, Year, Actions
- Card view on mobile with student details
- Total count: "X student(s) registered"

---

## 12. Screenshots

### Registration Form
![Registration Form](screenshots/01-registration-form.png)

### Validation Errors
![Validation Errors](screenshots/02-validation-errors.png)

### Successful Registration
![Successful Registration](screenshots/03-successful-registration.png)

### Flash Message
![Flash Message](screenshots/04-flash-message.png)

### Student Profile Page
![Student Profile](screenshots/05-student-profile.png)

### Student Listing
![Student Listing](screenshots/06-student-listing.png)

### Database Records
![Database Records](screenshots/07-database-records.png)

### VS Code Project Structure
![VS Code Structure](screenshots/08-vscode-structure.png)

### GitHub Repository
![GitHub Repository](screenshots/09-github-repository.png)

### Terminal Output
![Terminal Output](screenshots/10-terminal-output.png)

---

## 13. Problems Encountered & Solutions

### Problem 1: Image Upload Path Issues

**Problem**: Profile pictures were not being displayed on the student profile page, returning 404 errors.

**Cause**: The `storage:link` command was not executed, so the public URL `/storage/profile_pictures/*` did not resolve to the actual file location in `storage/app/public/profile_pictures/`.

**Solution**:
```bash
php artisan storage:link
```
This created the symbolic link from `public/storage` to `storage/app/public`, making uploaded images accessible via the web.

---

### Problem 2: Validation Errors Not Appearing

**Problem**: When submitting the form with invalid data, validation errors were not displayed to the user.

**Cause**: The Blade template was missing the `@error` directive to display validation messages, and the controller was not using `$request->validate()`.

**Solution**: Added validation rules in `StudentController::store()` and included `@error('field')` directives in the form template:
```php
// Controller
$validated = $request->validate([...]);

// View
@error('email')
    <p class="text-red-600">{{ $message }}</p>
@enderror
```

---

### Problem 3: Database Migration Failed

**Problem**: Running `php artisan migrate` failed with a "table already exists" error.

**Cause**: The migration had already been run previously, and the database was not cleared before re-running.

**Solution**:
```bash
php artisan migrate:fresh    # Drops all tables and re-runs migrations
# OR
php artisan migrate:reset    # Rolls back all migrations
php artisan migrate          # Runs migrations again
```

---

### Problem 4: Old Input Values Lost on Validation Failure

**Problem**: After a validation error, the form fields were empty, forcing users to re-enter all data.

**Cause**: The form inputs were not using Laravel's `old()` helper to repopulate values after a failed validation.

**Solution**: Added `old()` helper to all form fields:
```html
<input type="text" name="first_name" value="{{ old('first_name') }}">
```

---

### Problem 5: Profile Picture Overwrite

**Problem**: When a student updated their profile, the old profile picture was not deleted from storage.

**Cause**: The system was not deleting previous files before storing new ones.

**Solution**: Added file deletion logic before storing the new file:
```php
if ($student->profile_picture) {
    Storage::disk('public')->delete($student->profile_picture);
}
$validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
```

---

## 14. Reflection

Building the Student Registration System has been an invaluable learning experience that deepened my understanding of web application development with Laravel. This project reinforced the importance of proper data validation, file handling, and user interface design in creating robust and secure web applications.

One of the most significant lessons learned was the critical role of server-side validation. While client-side validation provides immediate feedback to users, it can be easily bypassed by disabling JavaScript or manipulating HTTP requests. Server-side validation acts as the ultimate safeguard, ensuring that only valid data reaches the database. The combination of `required`, `unique`, `email`, `numeric`, `image`, and `max` validation rules created a comprehensive validation layer that caught various types of invalid input.

File upload handling presented its own set of challenges. Understanding Laravel's storage system, including the difference between storing files locally versus in cloud storage, and the importance of symbolic links for public access, was crucial. The validation rules for image uploads (`image|mimes:jpg,jpeg,png|max:2048`) demonstrated how to balance security with functionality, preventing malicious file uploads while allowing legitimate images.

The project also highlighted the importance of user experience (UX) design. Flash messages for success and error feedback, preservation of user input after validation failures, and responsive design for mobile compatibility all contributed to a polished and professional application. The green theme with sidebar layout provided a modern and intuitive interface.

From a software engineering perspective, this project reinforced the value of the MVC (Model-View-Controller) architecture. Separating business logic (Controller), data management (Model), and presentation (View) made the codebase organized, maintainable, and testable. Laravel's Eloquent ORM simplified database operations, while Blade templating made creating dynamic views straightforward.

In real-world enterprise applications, registration systems serve as the foundation for user onboarding. Whether in educational institutions, healthcare systems, or corporate environments, the principles learned in this project—form handling, validation, file uploads, database integration, and user feedback—are directly applicable. The skills developed here extend beyond academic exercises and prepare students for building production-ready software.

Overall, this project successfully accomplished its objectives and provided practical experience with modern web development technologies and best practices.

*(Word count: 500)*

---

## 15. References

Laravel. (2026). *Laravel documentation*. https://laravel.com/docs

PHP. (2026). *PHP documentation*. https://www.php.net/docs

MySQL. (2026). *MySQL 8.0 reference manual*. https://dev.mysql.com/doc/refman/8.0/en/

Tailwind CSS. (2026). *Tailwind CSS documentation*. https://tailwindcss.com/docs

Mozilla Developer Network. (2026). *MDN web docs*. https://developer.mozilla.org/

Stack Overflow. (2026). *Stack Overflow: Where developers learn, share, & build careers*. https://stackoverflow.com

GitHub. (2026). *GitHub: Where the world builds software*. https://github.com

W3Schools. (2026). *W3Schools online web tutorials*. https://www.w3schools.com

Laracasts. (2026). *Laracasts: Laravel (and beyond) screencasts*. https://laracasts.com

DigitalOcean. (2026). *DigitalOcean community tutorials*. https://www.digitalocean.com/community/tutorials

---

## 16. License

MIT License

Copyright (c) 2026 College of Information Technology

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
