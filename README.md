# Student Management System

A full-stack Student Management System built using PHP, MySQL, Bootstrap, JavaScript, HTML5, and CSS3.

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
- Bootstrap 5
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
│   └── database.php
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