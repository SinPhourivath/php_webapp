<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

// Check if note ID is provided
if (!isset($_POST['note_id'])) {
    // Redirect to an error page or the dashboard
    header('Location: dashboard.php?error=note_id_missing');
    exit();
}

$note_id = $_POST['note_id'];

include_once 'pdo.php'; // Adjust this according to your file structure

try {
    $stmt = $pdo->prepare("DELETE FROM note WHERE id = ?");
    $stmt->execute([$note_id]);
    header('Location: dashboard.php');
    exit();
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?php echo "$note_id" ?></h1>
</body>
</html>