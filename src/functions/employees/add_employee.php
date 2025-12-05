<?php
require_once __DIR__ . '/../../config/database.php';

$conn = connectDB();

$modal = !empty($error);

// stops from directly going to this page
if (empty($_SESSION['employee_id'])) {
        header("Location: ../../login");
        exit;
}

// makes sure it only runs when form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'addEmployee')
{
    // get all inputs
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phoneNum = trim($_POST['phoneNum']);
    $position_id = $_POST['position_id'];

    // check if inputs are empty, set error if yes
    if (empty($firstName)) { $addError = 'First Name is Required'; }
    elseif (empty($lastName)) { $addError = 'Last Name is Required'; }
    elseif (empty($email)) { $addError = 'Email is required'; }
    elseif (empty($phoneNum)) { $addError = 'Phone Number is Required'; }
    elseif (empty($position_id)) { $addError = "Position of the Employee is Required"; }
    else 
    {
        try {
            //check if email is already in use by an employee
            $check = $conn->prepare("SELECT employee_id FROM employees WHERE email = ?");
            $check->execute([$email]);
            $userExists = $check->fetch(); 
            
            if ($userExists) { $error = "Email is already in use"; } // set error if email is in use
            else 
            {
                //insert into employee database
                $insert = $conn->prepare('INSERT INTO employees (first_name, last_name, email, contact_no, position_id) VALUES (?, ?, ?, ?, ?)');
                $insert->execute([$firstName, $lastName, $email, $phoneNum, $position_id]);

                $_SESSION['message'] = $firstName . " " . $lastName . ' has been hired.'; //get employee name for display message
                header ("Location: " . $_SERVER['PHP_SELF']);
                exit;
            }
        } catch (PDOException $e) {
            $addError = "Database error: " . $e->getMessage();
        }
    }
}

