<?php

require_once "../config/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($name) || empty($email) || empty($password)) {
        $message = "Please fill in all fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
    } elseif (strlen($password) < 8) {
        $message = "Password must be at least 8 characters.";
    } else {

        $check = $pdo->prepare(
            "SELECT id FROM users WHERE email = ?"
        );

        $check->execute([$email]);

        if ($check->fetch()) {

            $message = "Email is already registered.";

        } else {

            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            $stmt = $pdo->prepare(
                "INSERT INTO users (name, email, password, role)
                 VALUES (?, ?, ?, 'student')"
            );

            if ($stmt->execute([
                $name,
                $email,
                $hashedPassword
            ])) {

                $message = "Registration successful!";

            } else {

                $message = "Registration failed.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Register - Student Management System</title>

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    >
<script src="../js/validation.js"></script>
</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-body">

                    <h2 class="text-center mb-4">
                        Create Account
                    </h2>

                    <?php if (!empty($message)): ?>

                        <div class="alert alert-info">
                            <?= htmlspecialchars($message) ?>
                        </div>

                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Full Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label class="form-label">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                minlength="8"
                                required
                            >

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Register
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>