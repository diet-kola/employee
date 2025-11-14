<?php
require_once __DIR__ . '/../../config/database.php';
session_start();

$conn = connectDB();
$error = "";
$name = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    // get all inputs
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phoneNum = trim($_POST['phoneNum']);
    $position_id = $_POST['position_id'];

    // check if inputs are empty, set error if yes
    if (empty($firstName)) { $error = 'First Name is Required'; }
    elseif (empty($lastName)) { $error = 'Last Name is Required'; }
    elseif (empty($email)) { $error = 'Email is required'; }
    elseif (empty($phoneNum)) { $error = 'Phone Number is Required'; }
    elseif (empty($position_id)) { $error = "Position of the Employee is Required"; }
    else 
    {
        //check if email is already in use by an employee
        $check = $conn->prepare("SELECT employee_id FROM employees WHERE email = ?");
        $check->execute([$email]);
        $userExists = $check->fetch(); 
        
        if ($userExists) { $error = "Email is already in use"; } // set error if email is in use
        else 
        {
            //insert into allowed_email
            $insert = $conn->prepare('INSERT INTO allowed_email (email, is_admin) VALUES (?, false)');
            $insert->execute([$email]); 

            //insert into employee database
            $insert = $conn->prepare('INSERT INTO employees (first_name, last_name, email, contact_no, position_id) VALUES (?, ?, ?, ?, ?)');
            $insert->execute([$firstName, $lastName, $email, $phoneNum, $position_id]);

            $name = $firstName . " " . $lastName . ' has been hired.'; //get employee name for display message
        }
    }
}

