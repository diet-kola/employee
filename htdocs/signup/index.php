<?php
require_once '../../src/functions/signup-function.php';
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="styles.css">
</head>

<header>
    <div class="design-header">
        <h1>EMPLOYEE TRACKER</h1>
    </div>
</header>

<body>
    <div class="sign-in-container">
        <div class="sign-in-box">
            <div class="sign-in-header">
                <h2>Signup</h2>
            </div>

            <?php if (isset($error)): ?>
                <div class="error" style="color:red;margin:10px 0;">
                    <?= $error ?>
                </div>
            <?php endif; ?>

            <form class="sign-in-form" action="." method="POST">

                <div class="input-container">
                    <label for="first_name">FIrst Name</label>
                    <input type="text" name="first_name">
                </div>

                <div class="input-container">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name">
                </div>

                <div class="input-container">
                    <label for="email">Email</label>
                    <input type="email" name="email">
                </div>

                <div class="input-container">
                    <label for="email">Phone Number</label>
                    <input type="text" name="phone_num">
                </div>

                <div class="input-container">
                    <label for="password">Password</label>
                    <input type="password" name="password">
                </div>

                <button type="submit" class="sign-in-button">Register</button>

                <a href="../login/index.php" class="login-link">Already have an account? Log In</a>
            </form>
        </div>
    </div>
</body>

</html>