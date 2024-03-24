<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

$note_id = $_POST['note_id'];
$_SESSION['note_id'] = $_POST['note_id'];

include_once 'pdo.php';

try {
    $stmt = $pdo->prepare("SELECT * FROM note WHERE id = ?");
    $stmt->execute([$note_id]);
    $note = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Query failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Note</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="card">
                    <form action="update_note.php" method="post" style="padding: 10px;">
                        <label for="title">Title:</label><br>
                        <input type="text" id="title" name="title" value="<?php echo $note['title']; ?>" required><br><br>
    
                        <label for="content">Content:</label><br>
                        <textarea id="content" name="content" rows="10" cols="50" required><?php echo $note['content']; ?></textarea><br><br>
    
                        <input class="btn btn-primary" type="submit" value="Update Note">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
