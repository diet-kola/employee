<?php
require_once "../../src/functions/logging/login.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG IN</title>

    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class=" header-design">
            <h1>HOTEL EMPLOYEE TRACKER</h1>
        </div>
    </header>
    <div class="log-in-container">
        <div class="log-in-box">
            <div class="log-in-header">
                <h2>LOG IN</h2>
            </div>

            <?php if ($error): /*display message kung may error*/ ?> 
                <div class="error">
                    <?= $error ?> 
                </div>
            <?php endif; ?>
            
            <form class="log-in-form" action="." method="POST">

                <div class="input-container">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
                </div>
                <div class="input-container">
                    <label for="password">Password</label>
                    <input type="password"id="password" name="password">
                </div>

                <button type="submit" class="log-in-button">Log In</button>

            </form>

            <a href="../signup" class="login-link">Don't have an account? Register here </a>
        </div>
    </div>
</body>

<!-- <script src="../API/clearLogin.js"></script> -->

</html>