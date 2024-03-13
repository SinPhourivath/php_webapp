<?php
    session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <div class="row min-vh-100 justify-content-center align-items-center">
        <div class="col-md-5">
            <div class="card">
                <h2 class="card-title text-center">Login</h2>
                <div class="card-body py-md-4">
                    <form action="login_handling.php" method="POST">
                        <?php
                            // Check if there's an error in the session
                            if (isset($_SESSION['error'])) {
                                // Display the error box
                                echo '<div class="error-box">';
                                echo '<p>Wrong email or password, please try again.</p>';
                                echo '</div>';
                            
                                // Unset the error from the session to hide it on subsequent page loads
                                unset($_SESSION['error']);
                            }
                        ?>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo @$_SESSION['saved_email']; ?>" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="d-flex flex-row align-items-center justify-content-between">
                            <p>Don't have an account? <a href="register.php">register</a></p>
                            <div>
                                <input type="submit" hidden>
                                <button class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
    session_destroy();
?>