<?php
require "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

if (!empty($_POST['task'])) {
    $query = $pdo->prepare("INSERT INTO tasks(user_id, task) VALUES (?, ?)");
    $query->execute([$_SESSION["user_id"], $_POST['task']]);
}

header("Location: index.php");
exit;
