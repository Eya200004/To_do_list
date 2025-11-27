<?php
require "config.php";

if(!isset($_SESSION["user_id"])) {
    exit;
}

if(isset($_POST['id'], $_POST['task'])) {
    $id = $_POST['id'];
    $task = trim($_POST['task']);
    $user_id = $_SESSION['user_id'];

    if($task !== '') {
        $stmt = $pdo->prepare("UPDATE tasks SET task=? WHERE id=? AND user_id=?");
        $stmt->execute([$task,$id,$user_id]);
        echo "success";
    } else {
        echo "empty";
    }
}
