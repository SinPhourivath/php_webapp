<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">

        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="card">
                    <h2 class="card-title text-center">Register</h2>
                    <div class="card-body py-md-4">
                        <?php
                            require("db.php");
                        ?>
                        <form action="register.php" method="post">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php if(isset($email)) { echo $email; } ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="confirm_password" placeholder="confirm_password" required>
                            </div>
                            <div class="d-flex flex-row align-items-center justify-content-between">
                                <p>Already have an account? <a href="login.php">Login</a></p>
                                <input type="submit" class="btn btn-primary" value="Create Account" name="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>