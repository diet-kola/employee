<?php
require_once __DIR__ . '/../config/database.php';
session_start();

$conn = connectDB();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $email = trim($_POST["email"]);
    $password = $_POST['password'];

    // check if may allowed ba yung email para gumawa ng admin account
    if (empty($email)) { $error = "Email is required";}
    elseif (empty($password)) { $error = "Password is required";}
    elseif (strlen($password) < 8) { $error = "Password must be atleast 8 characters long";}
    else 
    {
         // gamit na ba ang email
        $check = $conn->prepare("SELECT * FROM employees WHERE email = ?");
        $check->execute([$email]);
        $userExists = $check->fetch();

        if (!$userExists) { $error = 'This email is not authorized to create an account';}
        else 
        {

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Update the employee record with the password
            $insertPassword= $conn->prepare("UPDATE employees SET password = ? WHERE email = ?");
            $insertPassword->execute([$hashedPassword, $email]);

            header ("Location: ../login");
            exit;
            
        }
    }
}
?> 