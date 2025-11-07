<?php
require_once __DIR__ . '/../config/database.php';
session_start();

$conn = connectDB();
$error = '';

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
    elseif (empty($password))
        { $error = "Password is required";}
    elseif (strlen($password) < 8) 
        { $error = "Password must be atleast 8 characters long";}
    else 
        {
            $check = $conn->prepare("SELECT * FROM admin_user WHERE email = ?");
            $check->execute([$email]);
            $userExists = $check->fetch();

            if ($userExists) {
                $error = "Email is already in use";
            } else {
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                $insert = $conn->prepare("INSERT INTO admin_user (name, email, password) VALUES (?, ?, ?)");
                $insert->execute([$name, $email, $hashedPassword]);

                header ("Location: ../signupSuccessful");
                exit;
            }
        }
}
?> 