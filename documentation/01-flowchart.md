# Registration Flowchart

## Overview

This flowchart illustrates the complete registration process from the user opening the form to viewing their profile.

## Flowchart

```
┌─────────────────────────────────────┐
│    User Opens Registration Page     │
│         /students/create            │
└──────────────────┬──────────────────┘
                   │
                   ▼
┌─────────────────────────────────────┐
│        Fill Out Registration Form   │
│  • Personal Information             │
│  • Contact Information              │
│  • Academic Information             │
│  • Address Information              │
│  • Profile Picture Upload           │
└──────────────────┬──────────────────┘
                   │
                   ▼
┌─────────────────────────────────────┐
│      Submit Registration Form       │
│         POST /students              │
└──────────────────┬──────────────────┘
                   │
                   ▼
┌─────────────────────────────────────┐
│        Laravel Validation           │
│  • Required fields check            │
│  • Unique constraints               │
│  • Email format validation          │
│  • Mobile number regex (09XX)       │
│  • Image type and size validation   │
└──────────────────┬──────────────────┘
                   │
              ┌────┴────┐
              │ Valid?  │
              └────┬────┘
                   │
          ┌────────┴────────┐
          │                 │
        Yes                 No
          │                 │
          ▼                 ▼
┌─────────────────┐  ┌─────────────────┐
│ Store to        │  │ Display Errors  │
│ Database        │  │ • Per-field     │
│ (MySQL)         │  │ • Summary       │
└────────┬────────┘  └────────┬────────┘
         │                    │
         ▼                    │
┌─────────────────┐           │
│ Upload Profile  │           │
│ Picture         │           │
│ (Storage)       │           │
└────────┬────────┘           │
         │                    │
         ▼                    │
┌─────────────────┐           │
│ Success Message │           │
│ Flash: "Student │◄──────────┘
│ registered      │  (old() values preserved)
│ successfully!"  │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│ Student Profile │
│ Page Display    │
│ /students/{id}  │
└─────────────────┘
```

## Decision Points

1. **Form Submission**: User clicks "Register Student" button
2. **Validation Check**: Laravel validates all fields server-side
3. **Success Path**: Redirect to profile page with flash message
4. **Error Path**: Return to form with errors and preserved input

## Key Components

- **Client-Side**: HTML form with Tailwind CSS styling
- **Server-Side**: Laravel Controller, Validation, Eloquent Model
- **Storage**: Laravel Storage for profile pictures
- **Database**: MySQL for persistent data storage
- **Feedback**: Flash messages for user notifications
