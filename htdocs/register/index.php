<?php
require_once '../../src/config/database.php';
session_start();

$conn = connectDB();
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST['password'];

    //Check if Inputs valid
    if (empty($name))
        { $error = "Name is required";}
    elseif (empty($email))
        { $error = "Email is required";}
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        { $error = "Invalid email format";}
    elseif (empty($password))
        { $error = "Password is required";}
    elseif (strlen($password) < 8) 
        { $error = "Password must be atleast 8 characters long";}
    else 
        {
            $check = $conn->prepare("SELECT * FROM admin_user WHERE email = ?");
            $check->execute([$email]);
            $userExists = $check->fetch();

            if ($userExists == true) {
                $error = "Email is already in use";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $insert = $conn->prepare("INSERT INTO admin_user (name, email, password) VALUES (?, ?, ?)");
                $insert->execute([$name, $email, $hashedPassword]);

                header ("Location: ../registerSuccessful/index.php");
                exit;
            }
        }
}
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="./styles.css">
</head>

<body>
    <div class="sign-in-container">
        <div class="sign-in-box">
            <div class="sign-in-header">
                <h2>Register</h2>
            </div>

            <?php if (isset($error)): ?>
                <div class="error" style="color:red;margin:10px 0;">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form class="sign-in-form" action="." method="POST">

                <div class="input-container">
                    <label for="full_name">Name</label>
                    <input type="full_name" name="full_name"> <!-- required> -->
                </div>

                <div class="input-container">
                    <label for="email">Email</label>
                    <input type="email" name="email"> <!-- required> -->
                </div>

                <div class="input-container">
                    <label for="password">Password</label>
                    <input type="password" name="password"> <!-- required> -->
                </div>

                <button type="submit" id="signIn" class="sign-in-button">Register</button>

                <a href="../login/index.php" class="login-link">Already have an account? Log In</a>
            </form>
        </div>
    </div>
</body>

</html>