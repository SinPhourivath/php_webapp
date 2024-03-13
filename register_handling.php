<?php
    # Establish PDO connection
    require 'pdo.php';
    global $pdo;

    # Registration
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $id = NULL;
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
    }

    // Check confirm password
    if ($confirm_password != $password) {
        session_start();
        $_SESSION['saved_email'] = $email;
        $_SESSION['error'] = 'confirm_password';
        header('Location: register.php');
        exit();
    }

    // Check if email is already used
    try {
        $stmt = $pdo->prepare("SELECT * FROM account WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            session_start();
            $_SESSION['saved_email'] = $email;
            $_SESSION['error'] = 'used_email';
            header('Location: register.php');
            exit();
        }
    } catch (PDOException $e) {
        echo "Query failed: " . $e->getMessage();
    }

    register($id, $email, $password);


    function register($id, $email, $password) {
        global $pdo;
        $query = "INSERT INTO account(id ,email, password) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$id, $email, $password]);
    }
?>
