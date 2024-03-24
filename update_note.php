<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

include_once 'pdo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $note_id = $_SESSION['note_id'];

    try {
        $stmt = $pdo->prepare("UPDATE note SET title = ?, content = ? WHERE id = ?");
        $stmt->execute([$title, $content, $note_id]);
        header('Location: dashboard.php');
        exit();
    } catch (PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }
}
?>
