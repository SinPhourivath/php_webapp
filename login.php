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
                    <h2 class="card-title text-center">Noter</h2>
                    <div class="card-body py-md-4">
                        <form action="login_handling.php" method="POST">
                            <?php
                                session_start();
                                if(isset($_GET['error']) && $_GET['error'] === "wrong_infomation") {
                                    echo '<div class="alert alert-danger">Wrong email or password. Please try again.</div>';
                                }
                            ?>
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo @$_SESSION['email']; ?>" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="d-flex flex-row align-items-center justify-content-between">
                                <p>Don't have an account? <a href="register.php">register</a></p>
                                <input type="submit" class="btn btn-primary" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    // Use JavaScript to remove the error message from the URL
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href.split("?")[0]);
    }
    </script>
</body>
</html>