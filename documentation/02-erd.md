# Entity Relationship Diagram (ERD)

## Overview

This document describes the database design for the Student Registration System, including the ERD, table structure, and constraints.

## Entity Relationship Diagram

```
┌─────────────────────────────────────────────────────────────────────────┐
│                              students                                   │
├─────────────────────────────────────────────────────────────────────────┤
│  PK  id                  BIGINT UNSIGNED        AUTO_INCREMENT          │
│      student_id          VARCHAR(255)           UNIQUE, NOT NULL        │
│      first_name          VARCHAR(100)           NOT NULL                │
│      middle_name         VARCHAR(100)           NULLABLE                │
│      last_name           VARCHAR(100)           NOT NULL                │
│      email               VARCHAR(255)           UNIQUE, NOT NULL        │
│      mobile_number       VARCHAR(11)            NOT NULL                │
│      date_of_birth       DATE                   NOT NULL                │
│      gender              VARCHAR(255)           NOT NULL                │
│      program             VARCHAR(255)           NOT NULL                │
│      year_level          VARCHAR(255)           NOT NULL                │
│      address             TEXT                   NOT NULL                │
│      profile_picture     VARCHAR(255)           NOT NULL                │
│      created_at          TIMESTAMP              NULLABLE                │
│      updated_at          TIMESTAMP              NULLABLE                │
└─────────────────────────────────────────────────────────────────────────┘
```

## Table Structure

### Table: students

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

## Data Types Explained

### VARCHAR (Variable Character)
- **Used for**: student_id, names, email, mobile_number, program, year_level, profile_picture
- **Why**: Variable-length strings are efficient for text fields with varying lengths
- **Sizes**: 100 for names, 255 for emails and IDs

### TEXT
- **Used for**: address
- **Why**: Addresses can be long and exceed VARCHAR limits
- **Advantage**: No need to specify exact length

### DATE
- **Used for**: date_of_birth
- **Why**: Stores date without time component, efficient for date comparisons
- **Format**: YYYY-MM-DD

### TIMESTAMP
- **Used for**: created_at, updated_at
- **Why**: Automatic tracking of record creation and modification times
- **Laravel Feature**: Auto-managed by Eloquent

### BIGINT UNSIGNED
- **Used for**: id (primary key)
- **Why**: Supports large number of records (up to 18 quintillion)
- **AUTO_INCREMENT**: Automatically generates unique IDs

## Primary Key

The `id` column serves as the primary key:
- **Type**: BIGINT UNSIGNED AUTO_INCREMENT
- **Purpose**: Uniquely identifies each student record
- **Laravel Convention**: Uses `bigIncrements()` in migrations

## Constraints

### UNIQUE Constraints
1. **student_id**: Prevents duplicate student registrations
   - Each student must have a unique identification number
   - Example: Cannot have two students with ID "2024-1001"

2. **email**: Ensures unique email addresses
   - Each student must have a unique email for communication
   - Prevents duplicate accounts with the same email

### NOT NULL Constraints
All fields except `middle_name` are NOT NULL:
- Ensures complete student records
- Prevents incomplete registrations from being saved
- Enforced at both application (validation) and database levels

### NULLABLE Fields
- **middle_name**: Optional field
- Some students may not have a middle name
- Allows flexibility in student information

## Migration Code (Laravel)

```php
Schema::create('students', function (Blueprint $table) {
    $table->id();
    $table->string('student_id')->unique();
    $table->string('first_name', 100);
    $table->string('middle_name', 100)->nullable();
    $table->string('last_name', 100);
    $table->string('email')->unique();
    $table->string('mobile_number', 11);
    $table->date('date_of_birth');
    $table->string('gender');
    $table->string('program');
    $table->string('year_level');
    $table->text('address');
    $table->string('profile_picture');
    $table->timestamps();
});
```

## Design Decisions

1. **Single Table Design**: All student information in one table for simplicity
2. **String Types for Enums**: gender, program, year_level stored as strings for flexibility
3. **Path Storage**: Only file path stored in database, not actual file
4. **Timestamps**: Automatic tracking of record creation and updates
5. **Unique Constraints**: Enforced at database level for data integrity
