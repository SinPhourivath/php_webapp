<?php
    # Establish PDO connection
    require 'pdo.php';
    global $pdo;

    # Login
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];
    }

    // Output email and password for debugging
    echo "Email: " . $email . "<br>";
    echo "Password: " . $password . "<br>";

    // Check email and password
    try {
        $stmt = $pdo->prepare("SELECT * FROM account WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row || !($password == $row['password'])) {
            session_start();
            $_SESSION['saved_email'] = $email;
            $_SESSION['error'] = 'wrong';
            header('Location: login.php');
            exit();
        }
    } catch (PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }

    header("Location: dashboard.php");
    exit();
?>
