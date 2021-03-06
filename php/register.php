<?php
    if (isset($_COOKIE['currentUsername'])) {
        header('Location: dashboard.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chocolate Factory: Register</title>
    <link rel="stylesheet" href="../styles/login.css">
</head>

<body>
    <div class="flex-container login-header">
        <h1>Willy Wangky Choco Factory</h1>
    </div>
    <div class="flex-container">
        <div class="login-form">
            <form id="register-form" action="registeruser.php" method="POST">
                <div class="form-control">
                    <label for="username"><strong>Username</strong></label>
                    <input class="input" type="text" name="username" id="username" required="" placeholder="example007">
                    <span class="validation" id="username-exists"></span>
                </div>
                <div class="form-control">
                    <label for="email"><strong>Email</strong></label>
                    <input class="input" type="email" name="email" id="email" required="" placeholder="example@example.com">
                </div>
                <div class="form-control">
                    <label for="password"><strong>Password</strong></label>
                    <input class="input" type="password" name="password" id="password" required="" placeholder="********">    
                </div>
                <div class="form-control">
                    <label for="confirm-password"><strong>Confirm Password</strong></label>
                    <input class="input" type="password" name="confirm-password" id="confirm-password" required="" placeholder="********">
                    <span class="validation" id="password-match"></span>
                </div>
                <button id="login-button" class="btn-login" type="submit">Register</button>
            </form>
            <a href="login.php">Already have an account? Login</a>
        </div>
    </div>
    <script src="../scripts/register.js"></script>
</body>

</html>