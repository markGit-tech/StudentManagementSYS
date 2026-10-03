<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

if ($_SESSION["role"] !== "admin") {
    header("Location: ../index.php");
    exit;
}

$stmt = $pdo->query("SELECT COUNT(*) FROM students");
$studentCount = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) FROM users");
$userCount = $stmt->fetchColumn();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Admin Dashboard - Student Management System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

</head>

<body>

<nav class="navbar navbar-dark bg-dark">

    <div class="container">

        <a
            href="../index.php"
            class="navbar-brand"
        >
            Student Management System
        </a>

        <div>

            <span class="text-white me-3">
                Admin:
                <?= htmlspecialchars($_SESSION["name"]) ?>
            </span>

            <a
                href="../auth/logout.php"
                class="btn btn-outline-light btn-sm"
            >
                Logout
            </a>

        </div>

    </div>

</nav>


<div class="container mt-5">

    <div class="mb-4">

        <h1>Admin Dashboard</h1>

        <p class="text-muted">
            Manage the student management system.
        </p>

    </div>


    <div class="row g-4">

        <!-- Students -->

        <div class="col-md-6">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h5 class="card-title">
                        Total Students
                    </h5>

                    <h2 class="display-5">
                        <?= $studentCount ?>
                    </h2>

                    <p class="text-muted">
                        Student records in the database.
                    </p>

                    <a
                        href="../students/index.php"
                        class="btn btn-primary"
                    >
                        Manage Students
                    </a>

                </div>

            </div>

        </div>


        <!-- Users -->

        <div class="col-md-6">

            <div class="card shadow-sm">

                <div class="card-body">

                    <h5 class="card-title">
                        Registered Users
                    </h5>

                    <h2 class="display-5">
                        <?= $userCount ?>
                    </h2>

                    <p class="text-muted">
                        Accounts registered in the system.
                    </p>

                </div>

            </div>

        </div>

    </div>


    <div class="card shadow-sm mt-4">

        <div class="card-body">

            <h5 class="card-title">
                Administrator Access
            </h5>

            <p class="card-text">
                You are logged in with administrator privileges.
            </p>

            <a
                href="../index.php"
                class="btn btn-secondary"
            >
                Back to Dashboard
            </a>

        </div>

    </div>

</div>

</body>
</html>