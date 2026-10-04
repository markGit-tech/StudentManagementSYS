# Student Management System

A full-stack Student Management System built using PHP, MySQL, Bootstrap, JavaScript, HTML5, and CSS3.

## Live Website

https://marcgajo-studentmanagement.infinityfree.io/

## Features

- User registration
- User login and logout
- Password hashing using PHP `password_hash()`
- Role-based access control
- Admin dashboard
- Student dashboard
- Add student records
- View student records
- Edit student records
- Delete student records
- Client-side JavaScript validation
- Server-side PHP validation
- Prepared statements for database queries
- XSS protection using `htmlspecialchars()`
- Responsive Bootstrap interface

## Technologies Used

- HTML5
- CSS3
- Bootstrap 5.3.3
- JavaScript
- PHP
- MySQL
- XAMPP

## Project Structure

```text
StudentManagementSYS/
├── admin/
│   └── dashboard.php
├── auth/
│   ├── login.php
│   ├── registration.php
│   └── logout.php
├── config/
│   └── database.php (not included in GitHub for security)
├── css/
│   └── style.css
├── database/
│   └── schema.sql
├── includes/
│   ├── auth.php
│   ├── header.php
│   └── footer.php
├── js/
│   └── validation.js
├── students/
│   ├── add.php
│   ├── delete.php
│   ├── edit.php
│   └── index.php
├── index.php
├── README.md
└── .gitignore

## Local Setup

1. Install XAMPP.
2. Start Apache and MySQL.
3. Copy the project folder to:

C:\xampp\htdocs\

4. Create a MySQL database named:

student_management_sys

5. Import the database schema from:

database/schema.sql

6. Configure the database connection in:

config/database.php

7. Open the system in your browser:

http://localhost/StudentManagementSYS/

## Test Credentials

### Admin Account

Email: admin@student.com  
Password: Admin123

### Student Account

Email: teststudent@example.com  
Password: Student123

## Security

- Passwords are securely hashed using `password_hash()`.
- Database queries use prepared statements.
- User input is validated on both client and server sides.
- Output is escaped using `htmlspecialchars()` to help prevent XSS attacks.
- Role-based authorization restricts admin-only pages.
- Database credentials are excluded from GitHub using `.gitignore`.