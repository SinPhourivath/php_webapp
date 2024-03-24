<?php
    require 'pdo.php';
    global $pdo;

    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = $_POST["password"];
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM account WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row || !($password == $row['password'])) {
            session_start();
            $_SESSION['email'] = $email;
            header('Location: login.php?error=wrong_infomation');
            exit();
        } else {
            session_start();
            $_SESSION['id'] = $row['id'];
            header("Location: dashboard.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }
?>