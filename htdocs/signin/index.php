<?php
//require_once '../../src/config/database.php';
//session_start();

//$conn = connectDB();

//if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //$email = $_POST['email'];
    //$password = $_POST['password'];

    //$stmt = $conn->prepare("INSERT INTO admin_user (email, password) VALUES (?, ?)");
    //$stmt->execute([$email, $password]);
//}
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="styles.css">

    <script src="./index.js"></script>
</head>

<body>
    <div class="sign-in-container">
        <div class="sign-in-box">
            <div class="sign-in-header">
                <h2>Sign In</h2>
            </div>

            <form class="sign-in-form" action="." method="POST">

                <div class="input-container">
                    <label for="email">Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="input-container">
                    <label for="password">Password</label>
                    <input type="password" name="password" required>
                </div>

                <button type="submit" id="signIn" class="sign-in-button">Sign In</button>
            </form>
        </div>
    </div>
</body>

</html>