<?php
require_once __DIR__ . '/../../config/database.php';

$conn = connectDB();

if ($_SERVER['REQUEST_METHOD'] && isset($_POST['deleteId'])) 
{
    $id = $_POST['deleteId'];

    $getEmployee = $conn->prepare('SELECT first_name, last_name FROM employees WHERE employee_id = ?');
    $getEmployee->execute([$id]);
    $employee = $getEmployee->fetch();

    //get employee name
    $_SESSION['deleted_employee'] = $employee['first_name'] . ' ' . $employee['last_name'] . ' has been fired.';
    
    $deleteAdmin = $conn->prepare('DELETE FROM admin_user WHERE employee_id = ?');
    $deleteAdmin->execute([$id]);

    $deleteEmployee = $conn->prepare('DELETE FROM employees WHERE employee_id = ?');
    $deleteEmployee->execute([$id]);

    header('Location: '. $_SERVER['PHP_SELF']);
    exit;

}
