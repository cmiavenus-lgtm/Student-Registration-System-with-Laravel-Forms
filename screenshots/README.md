# Screenshots

Place application screenshots here for documentation and presentation.

## Expected Screenshots

- `01-registration-form.png` — Student Registration Form (`/students/create`) showing Personal, Contact, Academic, Address, Profile Picture sections (green theme with sidebar)
- `02-student-list.png` — Registered Students listing (`/students`) table (desktop) and cards (mobile) with 15 students
- `03-student-profile.png` — Student Profile (`/students/{id}`) with prominent profile picture, flash `Student registered successfully!`, and Back/Register Another navigation
- `04-validation-errors.png` — Validation errors displayed beside each field and summary banner with `old()` values preserved
- `05-mobile-responsive.png` — Mobile view of sidebar toggle and responsive grid

## How to Capture

1. Run `php artisan serve` or `php -S 127.0.0.1:8010 -t public`
2. Open `http://127.0.0.1:8010/students/create` and `http://127.0.0.1:8010/students`
3. Use browser screenshot or `Snipping Tool`

Current app: green professional theme with sidebar, 15 students seeded, Academic Year 2026-2027.
