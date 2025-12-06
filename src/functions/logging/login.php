<?php
require_once __DIR__ . "/../../config/database.php";
session_start();

$conn = connectDB();
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    try {
        // get inputs
        $email = trim($_POST["email"]);
        $password = $_POST['password'];

        // check if inputs are empty
        if (empty($email)) { $error = "Email is required";} 
        elseif (empty($password)) { $error = "Password is required";}
        else 
        {
            
            //check if user exists
            $check = $conn->prepare("SELECT * FROM employees WHERE email = ?");
            $check->execute([$email]);
            $user = $check->fetch();

            if ($user && $user['password'] == null) { $error = 'Please signup your email first';}
            else if ($user && password_verify($password, $user['password'])) 
            {
                // get id of employee
                $_SESSION['employee_id'] = $user['employee_id'];
                //admin login
                if ($user['position_id'] == 9)
                {
                    $_SESSION['admin_name'] = $user['first_name'] . ' ' . $user['last_name'];
                    header('Location: ../admin_page/dashboard'); // redirect to dashboard
                    exit;
                }
                else
                {
                    //employee login
                    header('Location: ../profile_page'); // redirect to their profile\\
                    exit;
                }
                
            }
            else { $error = 'Invalid email or password'; }
        }
    } catch (PDOException $e) {
        $error = "An error occured during login";
    }
}
?>