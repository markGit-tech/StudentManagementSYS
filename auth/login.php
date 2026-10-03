<?php

session_start();

require_once "../config/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {

        $message = "Please fill in all fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $message = "Please enter a valid email address.";

    } else {

        $stmt = $pdo->prepare(
            "SELECT id, name, email, password, role
             FROM users
             WHERE email = ?"
        );

        $stmt->execute([$email]);

        $user = $stmt->fetch();

        if ($user && password_verify($password, $user["password"])) {

            $_SESSION["user_id"] = $user["id"];
            $_SESSION["name"] = $user["name"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["role"] = $user["role"];

            header("Location: ../index.php");
            exit;

        } else {

            $message = "Invalid email or password.";
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

    <title>Login - Student Management System</title>

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
                        Login
                    </h2>

                    <?php if (!empty($message)): ?>

                        <div class="alert alert-danger">
                            <?= htmlspecialchars($message) ?>
                        </div>

                    <?php endif; ?>

                    <form method="POST">

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
                                required
                            >

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Login
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>