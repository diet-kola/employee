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
        //check if admin exists
        $check = $conn->prepare("SELECT e.first_name, e.last_name, a.password, a.admin_id
                                 FROM admin_user a 
                                 JOIN employees e on e.employee_id = a.employee_id
                                 WHERE email = ? AND e.position_id = 9");
        $check->execute([$email]);
        $adminExists = $check->fetch();

        //redirect if admin exists and pw is correct
        if ($adminExists && password_verify($password, $adminExists['password'])) 
        {
            // store for future uses
            $_SESSION['admin_name'] = $adminExists['first_name'] . ' ' . $adminExists['last_name'];
            $_SESSION['admin_id'] = $adminExists['admin_id'];

            header('Location: ../mainPage'); // redirect to main page
            exit;
        } 
        else { $error = "Invalid email or password"; } // display error when admin doesnt exist
    }
}
?>