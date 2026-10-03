<?php

require_once "../includes/auth.php";
require_once "../config/database.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = $_GET["id"];

$stmt = $pdo->prepare(
    "DELETE FROM students WHERE id = ?"
);

$stmt->execute([$id]);

header("Location: index.php");
exit;

?>