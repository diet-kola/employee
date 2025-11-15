<?php
require_once __DIR__ . '/../../config/database.php';

$conn = connectDB();
// $employee = [];

if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['deleteId'])) 
{
    // get employee_id through hidden input
    $employeeId = $_POST['deleteId'];

    //get employee info
    $getEmployee = $conn->prepare("SELECT * FROM employees WHERE employee_id = ?");
    $getEmployee->execute([$employeeId]);
    $employee = $getEmployee->fetch();   

    // Prevent deletion of currently logged-in admin
    if (!empty($employee['employee_id']) && $employee['employee_id'] == $_SESSION['admin_id']) 
    {
        //display message 
        $_SESSION['message'] = $employee['first_name'] . " " . $employee['last_name'] . " is currently logged in and can't be deleted";
    }
    else
    {
        //get employee name for display message
        $_SESSION['message'] = $employee['first_name'] . " " . $employee['last_name'] . " has been fired.";

        //delete from admin_user table if employee is an admin
        $deleteAdmin = $conn->prepare("DELETE FROM admin_user WHERE employee_id = ?");
        $deleteAdmin->execute([$employeeId]);

        //delete from employees table
        $deleteEmployee = $conn->prepare("DELETE FROM employees WHERE employee_id = ?");
        $deleteEmployee->execute([$employeeId]);
    }
    header("Location: ."); // refresh page
    exit;
}
