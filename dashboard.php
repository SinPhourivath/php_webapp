<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit();
}

include_once 'pdo.php';

try {
    $stmt = $pdo->prepare("SELECT * FROM note WHERE account_id = ?");
    $stmt->execute([$_SESSION['id']]);
    $notes = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <br>
    <div class="container">
        <div class="d-flex justify-content-center">
            <h1>Your Notes</h1>
        </div>
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-start">
                    <a href="create_note.php" class="btn btn-primary">Create New Note</a>
                </div>
            </div>
            <div class="col">
                <div class="d-flex justify-content-end">
                    <div class="btn btn-primary">Sign Out</div>
                </div>
            </div>
        </div>
        <hr>
        <div class="d-flex gap-3">
            <?php foreach ($notes as $note): ?>
                <div class="card" style="width: 18rem; height: 13rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $note['title']; ?></h5>
                        <p><?php echo $note['created_at']; ?></p>
                        <p class="card-text"><?php echo truncateText($note['content'], 70); ?></p>
                    </div>
                    <div class="d-flex justify-content-end gap-1 p-2">
                        <a href="edit_note.php"><i class="fas fa-edit"></i></a>
                        <a href="#"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>

<?php
    function truncateText($text, $limit) {
        if (strlen($text) > $limit) {
            return substr($text, 0, $limit) . '...';
        } else {
            return $text;
        }
    }
?>