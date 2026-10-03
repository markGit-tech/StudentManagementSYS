<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = $_GET["id"];

$stmt = $pdo->prepare(
    "SELECT * FROM students WHERE id = ?"
);

$stmt->execute([$id]);

$student = $stmt->fetch();

if (!$student) {
    die("Student not found.");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $student_id = trim($_POST["student_id"]);
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $course = trim($_POST["course"]);
    $year_level = trim($_POST["year_level"]);
    $contact = trim($_POST["contact"]);

    if (
        empty($student_id) ||
        empty($first_name) ||
        empty($last_name) ||
        empty($email) ||
        empty($course) ||
        empty($year_level)
    ) {

        $message = "Please fill in all required fields.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $message = "Please enter a valid email address.";

    } else {

        $check = $pdo->prepare(
            "SELECT id FROM students
             WHERE student_id = ? AND id != ?"
        );

        $check->execute([
            $student_id,
            $id
        ]);

        if ($check->fetch()) {

            $message = "Student ID already exists.";

        } else {

            $update = $pdo->prepare(
                "UPDATE students
                 SET student_id = ?,
                     first_name = ?,
                     last_name = ?,
                     email = ?,
                     course = ?,
                     year_level = ?,
                     contact = ?
                 WHERE id = ?"
            );

            if ($update->execute([
                $student_id,
                $first_name,
                $last_name,
                $email,
                $course,
                $year_level,
                $contact,
                $id
            ])) {

                header("Location: index.php");
                exit;

            } else {

                $message = "Failed to update student.";

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

    <title>Edit Student - Student Management System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
<script src="../js/validation.js"></script>
</head>

<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-body">

                    <h2 class="mb-4">
                        Edit Student
                    </h2>

                    <?php if (!empty($message)): ?>

                        <div class="alert alert-danger">

                            <?= htmlspecialchars($message) ?>

                        </div>

                    <?php endif; ?>


                    <form method="POST">

                        <div class="mb-3">

                            <label class="form-label">
                                Student ID
                            </label>

                            <input
                                type="text"
                                name="student_id"
                                class="form-control"
                                value="<?= htmlspecialchars($student["student_id"]) ?>"
                                required
                            >

                        </div>


                        <div class="row">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    First Name
                                </label>

                                <input
                                    type="text"
                                    name="first_name"
                                    class="form-control"
                                    value="<?= htmlspecialchars($student["first_name"]) ?>"
                                    required
                                >

                            </div>


                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Last Name
                                </label>

                                <input
                                    type="text"
                                    name="last_name"
                                    class="form-control"
                                    value="<?= htmlspecialchars($student["last_name"]) ?>"
                                    required
                                >

                            </div>

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="<?= htmlspecialchars($student["email"]) ?>"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Course
                            </label>

                            <input
                                type="text"
                                name="course"
                                class="form-control"
                                value="<?= htmlspecialchars($student["course"]) ?>"
                                required
                            >

                        </div>


                        <div class="mb-3">

                            <label class="form-label">
                                Year Level
                            </label>

                            <select
                                name="year_level"
                                class="form-select"
                                required
                            >

                                <option value="1st Year"
                                    <?= $student["year_level"] === "1st Year" ? "selected" : "" ?>>
                                    1st Year
                                </option>

                                <option value="2nd Year"
                                    <?= $student["year_level"] === "2nd Year" ? "selected" : "" ?>>
                                    2nd Year
                                </option>

                                <option value="3rd Year"
                                    <?= $student["year_level"] === "3rd Year" ? "selected" : "" ?>>
                                    3rd Year
                                </option>

                                <option value="4th Year"
                                    <?= $student["year_level"] === "4th Year" ? "selected" : "" ?>>
                                    4th Year
                                </option>

                            </select>

                        </div>


                        <div class="mb-4">

                            <label class="form-label">
                                Contact
                            </label>

                            <input
                                type="text"
                                name="contact"
                                class="form-control"
                                value="<?= htmlspecialchars($student["contact"]) ?>"
                            >

                        </div>


                        <button
                            type="submit"
                            class="btn btn-warning"
                        >
                            Update Student
                        </button>


                        <a
                            href="index.php"
                            class="btn btn-secondary"
                        >
                            Cancel
                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>