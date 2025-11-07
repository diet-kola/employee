<?php
require_once __DIR__ . '/../../config/database.php';
session_start();

$conn = connectDB();
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phoneNum = trim($_POST['phoneNum']);
    $position_id = $_POST['position_id'];

    $name = $firstName . ' ' . $lastName;

    if (empty($firstName)) {
        $error = 'First Name is Required';
    }
    elseif (empty($lastName)) {
        $error = 'Last Name is Required';
    }
    elseif (empty($email)) {
        $error = 'Email is required';
    }
    elseif (empty($phoneNum)) {
        $error = 'Phone Number is Required';
    }
    elseif (empty($position_id)) {
        $error = "Position of the Employee is Required";
    }
    else {
        $check = $conn->prepare("SELECT * FROM admin_user WHERE email = ?");
        $check->execute([$email]);
        $userExists = $check->fetch(); 

        if ($userExists) {
            $error = "Email is already in use";
        } 
        else {
            $insert = $conn->prepare('INSERT INTO employees (first_name, last_name, email, contact_no, position_id) VALUES (?, ?, ?, ?, ?)');
            $insert->execute([$firstName, $lastName, $email, $phoneNum, $position_id]);
        }
    }
}

