<?php
require_once __DIR__ . "/../config/database.php";
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
    else 
    {
        $check = $conn->prepare("SELECT * FROM admin_user WHERE email = ?");
        $check->execute([$email]);
        $check = $check->fetch();

        if ($check && password_verify($password, $check['password'])) {
            header('Location: ../mainPage');
            exit;
        } else { 
            $error = "Invalid email or password"; 
        }
    }
}
?>