<?php
require_once "../../src/config/database.php";
session_start();

$conn = connectDB();
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST["email"]);
    $password = $_POST['password'];

    // check kung empty yung email at password
    if (empty($email))
    { $error = "Email is required";} 
    elseif (empty($password)) 
    { $error = "Password is required";}
    else {
        // Check kung nasa database ba yung email
        $check = $conn->prepare("SELECT * FROM admin_user WHERE email = ? AND password = ?");
        $check->execute([$email, $password]);
        $user = $check->fetch();

        // log in kung tama email at password, display error kung hindi
        if ($user) {
            header('Location: ../mainPage');
            exit;
        } else { 
            $error = "Invalid email or password"; 
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

            
            <?php if ($error): /*display message kung may error*/ ?>
                <div class="error" style="color:#b00020;margin:10px 0;">
                    <?= htmlspecialchars($error) ?> 
                </div>
            <?php endif; ?>
            
            <form class="sign-in-form" action="." method="POST">

                <div class="input-container">
                    <label for="email">Email</label>
                    <input type="email" name="email">
                </div>
                <div class="input-container">
                    <label for="password">Password</label>
                    <input type="password" name="password">
                </div>

                <button type="submit" id="signIn" class="sign-in-button">Log In</button>

            </form>
        </div>
    </div>
</body>
</html>