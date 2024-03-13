<?php
    require 'pdo.php';
    global $pdo;

    session_start();
    $_SESSION['email'] = $_POST['email'];

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
    }

    if ($confirm_password != $password) {
        header('Location: register.php?error=confirmation');
        exit();
    }

    // Check if email is already used
    try {
        $stmt = $pdo->prepare("SELECT * FROM account WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            header('Location: register.php?error=email');
            exit();
        }
    } catch (PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }

    $query = "INSERT INTO account(id, email, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([null, $email, $password]);

?>
