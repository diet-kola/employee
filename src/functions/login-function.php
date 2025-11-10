<?php
require_once __DIR__ . "/../config/database.php";
session_start();

$conn = connectDB();
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
    //kuha inputs
    $email = trim($_POST["email"]);
    $password = $_POST['password'];
    
    // check kung empty yung email at password
    if (empty($email)) { $error = "Email is required";} 
    elseif (empty($password)) { $error = "Password is required";}
    else 
    {
        $check = $conn->prepare("SELECT e.first_name, e.last_name, a.password 
                                    FROM admin_user a 
                                 JOIN employees e on e.employee_id = a.employee_id
                                    WHERE email = ? AND e.position_id = 9
                                    ");
        $check->execute([$email]);
        $check = $check->fetch();

        if ($check && password_verify($password, $check['password'])) 
        {
            $_SESSION['admin_name'] = $check['first_name'] . ' ' . $check['last_name'];
            header('Location: ../mainPage');
            exit;
        } 
        else 
        { 
            $error = "Invalid email or password"; 
        }
    }
}
?>