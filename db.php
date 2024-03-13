<?php
    if (isset($_POST["submit"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];

        if ($confirm_password !== $password) {
            echo "<div class='alert alert-danger'>Confirm password does not match, please try again.</div>";
        } else {
            echo "<div class='alert alert-success'>Account registered successfully!</div>";
        }
    }
?>