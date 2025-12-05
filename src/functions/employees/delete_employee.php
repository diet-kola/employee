<?php
require_once __DIR__ . '/../../config/database.php';

$conn = connectDB();
// $employee = [];

// stops from directly going to this page
if (empty($_SESSION['employee_id'])) {
    header("Location: ../../login");     
    exit;
}

// makes sure it only runs when form is submitted 
// added condition where deleteId from delete Id button is pressed to prevent from interfering with other buttons.
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['deleteId'])) 
{
    // get employee_id through hidden input
    $employeeId = $_POST['deleteId'];

    try {
        //get employee info
        $getEmployee = $conn->prepare("SELECT * FROM employees WHERE employee_id = ?");
        $getEmployee->execute([$employeeId]);
        $employee = $getEmployee->fetch();   

        // Prevent deletion of currently logged-in admin
        if (!empty($employee['employee_id']) && $employee['employee_id'] == $_SESSION['employee_id']) 
        {
            //display message 
            $_SESSION['message'] = $employee['first_name'] . " " . $employee['last_name'] . " is currently logged in and can't be deleted";
        }
        else
        {
            //get employee name for display message
            $_SESSION['message'] = $employee['first_name'] . " " . $employee['last_name'] . " has been fired.";

             // Delete associated schedules first
            $deleteSchedules = $conn->prepare("DELETE FROM schedules WHERE employee_id = ?");
            $deleteSchedules->execute([$employeeId]);
            
            //delete from employees table
            $deleteEmployee = $conn->prepare("DELETE FROM employees WHERE employee_id = ?");
            $deleteEmployee->execute([$employeeId]);
        }   
    } catch (PDOException $e) {
        $error = "Error deleting employee: " . $e->getMessage();
    }
    header("Location: ."); // refresh page
    exit;
}
