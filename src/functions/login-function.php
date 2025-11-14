<?php
require_once __DIR__ . "/../config/database.php";
session_start();

$conn = connectDB();
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    // get inputs
    $email = trim($_POST["email"]);
    $password = $_POST['password'];

    // check if inputs are empty
    if (empty($email)) { $error = "Email is required";} 
    elseif (empty($password)) { $error = "Password is required";}
    else 
    {
        //check if user exists
        $check = $conn->prepare("SELECT e.employee_id, e.first_name, e.last_name, e.password, e.position_id, a.admin_id
                                    FROM employees e
                                LEFT JOIN admin_user a ON e.employee_id = a.employee_id
                                    WHERE e.email = ?");
        $check->execute([$email]);
        $user = $check->fetch();

        if ($user && password_verify($password, $user['password'])) 
        {
            if ($user['position_id'] == 9)
            {
                $_SESSION['admin_name'] = $user['first_name'] . ' ' . $user['last_name'];
                $_SESSION['admin_id'] = $user['admin_id'];
                header('Location: ../mainPage');
                exit;
            }
            else
            {
                // Employee login
                $_SESSION['employee_name'] = $user['first_name'] . ' ' . $user['last_name'];
                $_SESSION['employee_id'] = $user['employee_id'];
                header('Location: ../profile_page'); // redirect to their profile
                exit;
            }
        }
        else { $error = 'Invalid email or password'; }
    }
}
?>