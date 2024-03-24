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
        $account_id = $_SESSION['id'];
    
        try {
            $stmt = $pdo->prepare("INSERT INTO note (title, content, account_id) VALUES (?, ?, ?)");
            $stmt->execute([$title, $content, $account_id]);
        
            header('Location: dashboard.php');
            exit();
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="card">
                    <form action="create_note.php" method="post" style="padding: 10px;">
                        <label for="title">Title:</label><br>
                        <input type="text" id="title" name="title" required><br><br>
    
                        <label for="content">Content:</label><br>
                        <textarea id="content" name="content" rows="10" cols="50"></textarea><br><br>
    
                        <input class="btn btn-primary" type="submit" value="Create Note">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>