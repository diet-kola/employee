<?php
require_once __DIR__ . '/../../config/database.php';

$conn = connectDB();
$employeeId = $_POST['updateId'];

if (empty($_SESSION['employee_id'])) {
        header("Location: ../../login");
        exit;
}  

// get employee
$getEmployee = $conn->prepare("SELECT * FROM employees WHERE employee_id = ?");
$getEmployee->execute([$employeeId]);
$employee = $getEmployee->fetch();

// get admin if employee is admin
$getAdmin = $conn->prepare("SELECT * FROM admin_user WHERE employee_id = ?");
$getAdmin->execute([$employeeId]);
$admin = $getAdmin->fetch();

//get all positions
$getPositions = $conn->query("SELECT * FROM positions ORDER BY position_id");
$positions = $getPositions->fetchAll();

$employeeName = $employee['first_name'] . " " . $employee['last_name'];

if (!empty($admin['admin_id']) && $admin['admin_id'] == $_SESSION['admin_id']) 
{ 
  $_SESSION['message'] = $employeeName . " is currently logged in and can't be updated"; 
  header("Location: ../../mainPage"); // redirect back to main page
  exit;
}
elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['first_name'])) 
{
  $firstName = trim($_POST['first_name']);
  $lastName = trim($_POST['last_name']);
  $email = trim($_POST['email']);
  $contactNo = trim($_POST['contact_no']);
  $positionId = $_POST['position_id'];

  if (empty($firstName)) { $error = "First name is required.";}
  elseif (empty($lastName)) { $error = "Last name is required.";}
  elseif (empty($email)) { $error = "Email is required.";}
  elseif (empty($contactNo)) { $error = "Contact number is required.";}
  elseif (empty($positionId)) { $error = "Position is required."; }
  else
  {
    $update = $conn->prepare("UPDATE employees
                              SET first_name = ?, last_name = ?, email = ?, contact_no = ?, position_id = ?
                              WHERE employee_id = ?
                            ");
    $update->execute([$firstName, $lastName, $email, $contactNo, $positionId, $employeeId]);

    if ($_SESSION['admin_id'] == $employee['employee_id'])
    {
      $_SESSION['admin_name'] = $firstName . ' ' . $lastName;
    }

    $_SESSION['message'] = $employeeName . "'s information has been updated";
    header("Location: ../../employees"); // redirect back to main page
    exit;
  }
}