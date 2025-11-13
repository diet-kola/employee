<?php
require_once __DIR__ . '/../config/database.php';
session_start();

$conn = connectDB();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    // get inputs
    $firstName = trim($_POST["first_name"]);
    $lastName = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $phoneNum = trim($_POST["phone_num"]);
    $password = $_POST['password'];
    $positionID = 9; // 9 is admin position in database

    // check kung tama inputs
    if (empty($firstName)) { $error = "First Name is required";}
    elseif (empty($lastName)) { $error = "Last Name is required";}
    elseif (empty($email)) { $error = "Email is required";}
    elseif (empty($phoneNum)) { $error = "Phone Number is required";}
    elseif (empty($password)) { $error = "Password is required";}
    elseif (strlen($password) < 8) { $error = "Password must be atleast 8 characters long";}
    else 
    {
        // gamit na ba ang email
        $check = $conn->prepare("SELECT * FROM employees WHERE email = ?");
        $check->execute([$email]);
        $userExists = $check->fetch();

        if ($userExists) { $error = "Email is already in use"; } 
        else 
        {
            //Encrypts passwod
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            
            //Inserts admin user sa employee table
            $insertEmployee = $conn->prepare("INSERT INTO employees (first_name, last_name, email, contact_no, position_id) VALUES (?, ?, ?, ?, ?)");
            $insertEmployee->execute([$firstName, $lastName, $email, $phoneNum, $positionID]);

            $employeeID = $conn->lastInsertId(); // get last id inserted
                
            //Insert user as an admin
            $insertAdmin = $conn->prepare('INSERT INTO admin_user (employee_id, password) VALUES (?, ?)');
            $insertAdmin->execute([$employeeID, $hashedPassword]);

            // Redirection
            header ("Location: ../login");
            exit;
        }
    }
}
?> 