# Laravel Request Lifecycle

## Overview

Understanding the Laravel request lifecycle is essential for building robust web applications. This document explains how a registration request moves through the Laravel framework.

## Request Lifecycle Diagram

```
┌─────────────────────────────────────────────────────────────────────────┐
│                            LARAVEL REQUEST LIFECYCLE                     │
└─────────────────────────────────────────────────────────────────────────┘

┌─────────────┐
│   Browser   │  1. User fills form and clicks "Register Student"
│   (Client)  │     POST /students
└──────┬──────┘
       │
       ▼
┌─────────────┐
│  HTTPKernel │  2. Request enters Laravel through public/index.php
│  (Entry)    │     Bootstraps application
└──────┬──────┘
       │
       ▼
┌─────────────┐
│   Router    │  3. Matches POST /students to StudentController@store
│  (web.php)  │     Route defined in routes/web.php
└──────┬──────┘
       │
       ▼
┌─────────────┐
│ Controller  │  4. StudentController::store() receives Request object
│  (Store)    │     Calls $request->validate([...])
└──────┬──────┘
       │
       ▼
┌─────────────┐
│ Validation  │  5. Laravel validates all fields against rules
│   Service   │     Returns errors if validation fails
└──────┬──────┘
       │
   ┌───┴───┐
   │Valid? │
   └───┬───┘
  Yes  │  No
   │   └──→ back()->withErrors() + withInput()
   ▼
┌─────────────┐
│   Model     │  6. Student::create($validated)
│  (Eloquent) │     Mass assignment with $fillable
└──────┬──────┘
       │
       ▼
┌─────────────┐
│  Database   │  7. INSERT INTO students (...) VALUES (...)
│   (MySQL)   │     Query executed via Query Builder
└──────┬──────┘
       │
       ▼
┌─────────────┐
│  Response   │  8. Redirect to /students/{id}
│  (Redirect) │     with('success', 'Student registered successfully!')
└──────┬──────┘
       │
       ▼
┌─────────────┐
│   Browser   │  9. Displays student profile page
│   (Client)  │     with green flash notification
└─────────────┘
```

## Detailed Lifecycle Steps

### Step 1: Browser Request
The user fills out the registration form and clicks "Register Student". The browser sends a `POST` request to `/students` with form data including:
- Student ID, names, email, mobile number
- Date of birth, gender, program, year level
- Address, profile picture file

### Step 2: HTTP Kernel
The request enters Laravel through `public/index.php`, which:
- Autoloader loads all required classes
- Application kernel bootstraps
- Service providers are registered

### Step 3: Route Matching
Laravel's router matches the `POST /students` request to:
```php
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
```
Defined in `routes/web.php`.

### Step 4: Controller Execution
`StudentController::store()` is invoked with the `Request` object:
```php
public function store(Request $request)
{
    $validated = $request->validate([...]);
    // ...
}
```

### Step 5: Validation
Laravel's validation service checks each field:
```php
'student_id' => 'required|unique:students,student_id',
'email' => 'required|email|unique:students,email',
// ... other rules
```

If validation fails:
- Throws `ValidationException`
- Redirects back to form
- Attaches error messages
- Preserves old input values

### Step 6: Model Creation
If validation passes, Eloquent creates a new record:
```php
$student = Student::create($validated);
```
The `$fillable` array in `Student.php` allows mass assignment:
```php
protected $fillable = [
    'student_id', 'first_name', 'middle_name', 'last_name',
    'email', 'mobile_number', 'date_of_birth', 'gender',
    'program', 'year_level', 'address', 'profile_picture',
];
```

### Step 7: Database Operation
Eloquent generates and executes an INSERT query:
```sql
INSERT INTO students (student_id, first_name, ..., created_at, updated_at)
VALUES ('2024-1001', 'Juan', ..., NOW(), NOW());
```

### Step 8: Response Generation
The controller returns a redirect response:
```php
return redirect()->route('students.show', $student->id)
    ->with('success', 'Student registered successfully!');
```

### Step 9: Browser Display
The browser receives the redirect and loads `/students/{id}`, displaying:
- Student profile with all information
- Profile picture
- Green flash message "Student registered successfully!"

## Error Flow

When validation fails:

```
Browser → Route → Controller → Validation (FAILS)
                                    │
                                    ▼
                              Back to Form
                              with Errors
                              + Old Input
                                    │
                                    ▼
                              Display Errors
                              + Preserve Input
```

## Key Concepts

### Middleware
Requests pass through middleware for:
- CSRF token verification
- Session management
- Authentication (if required)

### Service Container
Laravel's IoC container resolves dependencies:
- Injects `Request` object into controller
- Resolves `Student` model for route model binding

### Response Objects
Laravel returns proper HTTP responses:
- `302 Found` for redirects
- `200 OK` for successful page loads
- `422 Unprocessable Entity` for validation errors
- `500 Internal Server Error` for exceptions

## Performance Considerations

- **Route Caching**: Cache routes in production for faster matching
- **Config Caching**: Cache configuration files
- **View Caching**: Compile Blade templates once
- **Eager Loading**: Prevent N+1 query problems

## Conclusion

The Laravel request lifecycle demonstrates the framework's elegant architecture, where each component has a specific responsibility. Understanding this flow helps developers:
- Debug issues effectively
- Optimize performance
- Write maintainable code
- Follow Laravel best practices
