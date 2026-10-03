<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

$stmt = $pdo->query(
    "SELECT * FROM students ORDER BY id DESC"
);

$students = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Students - Student Management System</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Student List</h2>

        <a href="add.php" class="btn btn-primary">
            Add Student
        </a>

    </div>

    <div class="card shadow">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped">

                    <thead class="table-dark">

                        <tr>
                            <th>ID</th>
                            <th>Student ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Year Level</th>
                            <th>Contact</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php if (empty($students)): ?>

                        <tr>
                            <td colspan="9" class="text-center">
                                No students found.
                            </td>
                        </tr>

                    <?php else: ?>

                        <?php foreach ($students as $student): ?>

                            <tr>

                                <td>
                                    <?= htmlspecialchars($student["id"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($student["student_id"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($student["first_name"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($student["last_name"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($student["email"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($student["course"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($student["year_level"]) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($student["contact"]) ?>
                                </td>

                                <td>

                                    <a
                                        href="edit.php?id=<?= $student["id"] ?>"
                                        class="btn btn-sm btn-warning"
                                    >
                                        Edit
                                    </a>

                                    <a
                                        href="delete.php?id=<?= $student["id"] ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this student?');"
                                    >
                                        Delete
                                    </a>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <div class="mt-3">

        <a href="../index.php" class="btn btn-secondary">
            Back to Home
        </a>

    </div>

</div>

</body>
</html>