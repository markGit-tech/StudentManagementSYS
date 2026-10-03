<?php

require_once "includes/auth.php";
require_once "config/database.php";

$stmt = $pdo->query("SELECT COUNT(*) FROM students");
$studentCount = $stmt->fetchColumn();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Dashboard - Student Management System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body>

<nav class="navbar navbar-dark bg-dark">

    <div class="container">

        <a class="navbar-brand" href="index.php">
            Student Management System
        </a>

        <div>

            <span class="text-white me-3">
                <?= htmlspecialchars($_SESSION["name"]) ?>
            </span>

            <a
                href="auth/logout.php"
                class="btn btn-outline-light btn-sm"
            >
                Logout
            </a>

        </div>

    </div>

</nav>


<div class="container mt-5">

    <div class="mb-4">

        <h1>
            Welcome,
            <?= htmlspecialchars($_SESSION["name"]) ?>!
        </h1>

        <p class="text-muted">
            Welcome to your Student Management System dashboard.
        </p>

    </div>


    <div class="row g-4">

        <!-- Student Count -->

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h5 class="card-title">
                        Total Students
                    </h5>

                    <h2 class="display-5">
                        <?= $studentCount ?>
                    </h2>

                    <p class="text-muted">
                        Registered students
                    </p>

                </div>

            </div>

        </div>


        <!-- Student Management -->

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h5 class="card-title">
                        Student Management
                    </h5>

                    <p class="card-text">
                        View, add, edit, and delete student records.
                    </p>

                    <a
                        href="students/index.php"
                        class="btn btn-primary"
                    >
                        Manage Students
                    </a>

                </div>

            </div>

        </div>


        <!-- Account -->

        <div class="col-md-4">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h5 class="card-title">
                        My Account
                    </h5>

                    <p class="mb-1">
                        <strong>Email:</strong>
                        <?= htmlspecialchars($_SESSION["email"]) ?>
                    </p>

                    <p>
                        <strong>Role:</strong>
                        <?= htmlspecialchars($_SESSION["role"]) ?>
                    </p>

                </div>

            </div>

        </div>

    </div>


    <?php if ($_SESSION["role"] === "admin"): ?>

        <div class="card shadow-sm mt-4">

            <div class="card-body">

                <h5 class="card-title">
                    Administrator
                </h5>

                <p class="card-text">
                    Access the administrator dashboard.
                </p>

                <a
                    href="admin/dashboard.php"
                    class="btn btn-dark"
                >
                    Admin Dashboard
                </a>

            </div>

        </div>

    <?php endif; ?>

</div>


</body>
</html>