<?php
require_once "../../src/config/database.php";
session_start();

$conn = connectDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST["email"]);
    $password = $_POST['password'];

    if (empty($email))
    { $error = "Email is required";} 
    elseif (empty($password)) 
    { $error = "Password is required";}
    else {
        // Check if the user exists in the database
        $stmt = $conn->prepare("SELECT * FROM admin_user WHERE name = ? AND email = ? AND password = ?");
        $stmt->execute([$name, $email, $password]);
        $user = $stmt->fetch();

        if ($user) {
            // Redirect to a protected page or dashboard
            header('Location: ../mainPage');
            exit;
        } else {
            // Handle login failure - you might want to set an error message here
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="sign-in-container">
        <div class="sign-in-box">
            <div class="sign-in-header">
                <h2>Log In</h2>
            </div>

            <form class="sign-in-form" action="." method="POST">

                <div class="input-container">
                    <label for="name">Name</label>
                    <input type="name" name="name">
                </div>
                <div class="input-container">
                    <label for="email">Email</label>
                    <input type="email" name="email">
                </div>
                <div class="input-container">
                    <label for="password">Password</label>
                    <input type="password" name="password">
                </div>

                <button type="submit" id="signIn" class="sign-in-button">Sign In</button>
            </form>
        </div>
    </div>
</body>
</html>