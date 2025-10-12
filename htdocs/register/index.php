<?php
require_once '../../src/config/database.php';
session_start();

$conn = connectDB();
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST["full_name"]);
    $email = trim($_POST["email"]);
    $password = $_POST['password'];

    //Check if email and password are empty
    if (empty($name))
    { $error = "Full name is required";}
    elseif (empty($email))
    { $error = "Email is required";}
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    { $error = "Invalid email format";}
    elseif (empty($password))
    { $error = "Password is required";}
    else 
    {
        // Check if email already exists in database
        $check = $conn->prepare("SELECT id FROM admin_user WHERE email = ?");
        $check->execute([$email]);

        if ($check->fetch()) 
        { $error = "Email is already in use";}
        else
        {
            // Insert email and password into database
            $stmt = $conn->prepare("INSERT INTO admin_user (name, email, password) VALUES (?, ?, ?) RETURNING id");
            $stmt->execute([$name, $email, $password]);
            $newID = $stmt->fetchColumn();

            // Redirect to register successful page after submitting
            header('Location: ../registerSuccessful?user_id=' . (int)$newID);
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

            <?php if ($error): ?>
                <div class="error" style="color:#b00020;margin:10px 0;">
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