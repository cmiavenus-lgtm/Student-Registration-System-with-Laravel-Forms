# Screenshots

Place application screenshots here for documentation and presentation.

## Required Screenshots

### 1. Registration Form
![Registration Form](01-registration-form.png)

**How to capture:**
1. Run `php artisan serve`
2. Open `http://localhost:8000/students/create`
3. Take a screenshot of the complete form showing all 5 sections

**What to show:**
- Personal Information section (Student ID, Names)
- Contact Information section (Email, Mobile Number)
- Academic Information section (DOB, Gender, Program, Year Level)
- Address Information section (Province, Municipality, Barangay, Address)
- Profile Picture Upload section

---

### 2. Validation Errors
![Validation Errors](02-validation-errors.png)

**How to capture:**
1. Open the registration form
2. Submit the form with empty fields (click "Register Student" without filling anything)
3. Take a screenshot showing the error messages

**What to show:**
- Red error messages next to each required field
- Error summary banner at the top
- Form fields highlighted in red

---

### 3. Successful Registration
![Successful Registration](03-successful-registration.png)

**How to capture:**
1. Fill out the registration form completely
2. Upload a profile picture (JPG or PNG, max 2MB)
3. Click "Register Student"
4. Take a screenshot of the redirected page

**What to show:**
- Student profile page with all information displayed
- Profile picture visible
- Green flash message "Student registered successfully!"

---

### 4. Flash Message
![Flash Message](04-flash-message.png)

**How to capture:**
1. Complete a successful registration
2. Take a close-up screenshot of the green success notification

**What to show:**
- Green background flash message
- Text "Student registered successfully!"
- Dismiss button (X)

---

### 5. Student Profile Page
![Student Profile](05-student-profile.png)

**How to capture:**
1. After successful registration, you're on the profile page
2. Take a full screenshot of the profile page

**What to show:**
- Profile picture (large, centered)
- Student ID and full name
- All personal information displayed
- Academic details
- Address information
- Back button and navigation

---

### 6. Student Listing
![Student Listing](06-student-listing.png)

**How to capture:**
1. Open `http://localhost:8000/students`
2. Take a screenshot of the student table

**What to show:**
- Table with columns: Student ID, Name, Email, Program, Year Level, Actions
- Multiple student records
- Total count "X student(s) registered"
- View buttons for each student

---

### 7. Database Records
![Database Records](07-database-records.png)

**How to capture:**
1. Open phpMyAdmin or MySQL Workbench
2. Select `student_registration` database
3. Open `students` table
4. Take a screenshot of the data

**What to show:**
- Table structure with all columns
- At least 3-5 student records
- Data including student_id, names, email, etc.

---

### 8. VS Code Project Structure
![VS Code Structure](08-vscode-structure.png)

**How to capture:**
1. Open the project in VS Code
2. Expand the file explorer to show the structure
3. Take a screenshot of the file tree

**What to show:**
- app/Http/Controllers/StudentController.php
- app/Models/Student.php
- database/migrations/
- resources/views/students/
- routes/web.php
- screenshots/
- documentation/

---

### 9. GitHub Repository
![GitHub Repository](09-github-repository.png)

**How to capture:**
1. Push your code to GitHub
2. Open your repository page
3. Take a screenshot of the repository

**What to show:**
- Repository name: week04-student-registration
- File structure
- Recent commits (10+ commits)
- README.md visible
- Public repository badge

---

### 10. Terminal Output
![Terminal Output](10-terminal-output.png)

**How to capture:**
1. Run `php artisan serve` in terminal
2. Take a screenshot showing:
   - Server running message
   - URL: http://127.0.0.1:8000
   - Any recent commands executed

**What to show:**
- Successful artisan serve output
- Database migration status
- Any relevant terminal commands

---

## How to Take Screenshots

### Windows
- **Snipping Tool**: Press `Win + Shift + S`
- **Snip & Sketch**: Built-in screenshot tool
- **Print Screen**: Press `PrtScn` then paste in Paint

### macOS
- **Cmd + Shift + 4**: Select area
- **Cmd + Shift + 3**: Full screen
- **Cmd + Shift + 5**: Screenshot menu

### VS Code
- **Extension**: "Screenshot" by nicholasxjy
- **Command**: `Ctrl + Shift + P` → "Take Screenshot"

## Screenshot Naming Convention

Name your screenshots as follows:
```
01-registration-form.png
02-validation-errors.png
03-successful-registration.png
04-flash-message.png
05-student-profile.png
06-student-listing.png
07-database-records.png
08-vscode-structure.png
09-github-repository.png
10-terminal-output.png
```

## Tips

1. **Resolution**: Take screenshots at 1920x1080 or higher
2. **Browser**: Use Chrome or Edge for consistent rendering
3. **Clean UI**: Close unnecessary browser tabs and extensions
4. **Data**: Use realistic sample data for professional appearance
5. **Annotations**: Add arrows or highlights if needed (use Paint or Snipping Tool)
