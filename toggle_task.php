<?php
require "config.php";

if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $query = $pdo->prepare("UPDATE tasks SET is_done = NOT is_done WHERE id = ? AND user_id = ?");
    $query->execute([$_GET['id'], $_SESSION['user_id']]);
}

header("Location: index.php");
exit;
