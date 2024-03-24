<?php
    require 'pdo.php';
    global $pdo;

    
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
    }

    if ($confirm_password != $password) {
        session_start();
        $_SESSION['email'] = $email;
        header('Location: register.php?error=confirmation');
        exit();
    }

    // Check if email is already used
    try {
        $stmt = $pdo->prepare("SELECT * FROM account WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            session_start();
            $_SESSION['email'] = $email;
            header('Location: register.php?error=registered_email');
            exit();
        }
    } catch (PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }

    $query = "INSERT INTO account(id, email, password) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([null, $email, $password]);
    session_destroy();
    header('Location: register.php?register=successful');
?>
