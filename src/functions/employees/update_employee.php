<?php
require_once __DIR__ . '/../../config/database.php';

$conn = connectDB();

if (empty($_SESSION['employee_id'])) {
        header("Location: ../../login");
        exit;
}  

// get all positions
$getPositions = $conn->query("SELECT * FROM positions ORDER BY position_id");
$positions = $getPositions->fetchAll();

// goes thruogh only when update button is clicked
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'updateEmployee') 
{
  $employeeId = $_POST['updateId']; 

  // get employees
  $getEmployee = $conn->prepare("SELECT * FROM employees WHERE employee_id = ?");
  $getEmployee->execute([$employeeId]);
  $employee = $getEmployee->fetch();

  $employeeName = $employee['first_name'] . " " . $employee['last_name']; // store name for display

  // stops the user from editing himself.
  if ($employee['employee_id'] == $_SESSION['employee_id']) {
    $_SESSION['admin_name'] = $employeeName . " is currently logged in and can't be updated";
    header("Location: .");
    exit;
  }

  //get input
  $firstName = trim($_POST['first_name']);
  $lastName = trim($_POST['last_name']);
  $email = trim($_POST['email']);
  $contactNo = trim($_POST['phoneNum']);
  $positionId = $_POST['position_id'];

  //error handling
  if (empty($firstName)) { $updError = "First name is required.";}
  elseif (empty($lastName)) { $updError = "Last name is required.";}
  elseif (empty($email)) { $updError = "Email is required.";}
  elseif (empty($contactNo)) { $updError = "Contact number is required.";}
  elseif (empty($positionId)) { $updError = "Position is required."; }
  else
  {
      try { 
        //update query
      $update = $conn->prepare("UPDATE employees
                                SET first_name = ?, last_name = ?, email = ?, contact_no = ?, position_id = ?
                                WHERE employee_id = ?
                              ");
      $update->execute([$firstName, $lastName, $email, $contactNo, $positionId, $employeeId]);

      $_SESSION['message'] = $employeeName . "'s information has been updated";
      header("Location: ."); // redirect back to main page
      exit;
      } catch (PDOException $e) {
        $updError = "Database Error: " . $e->getMessage();
      }
  }
}