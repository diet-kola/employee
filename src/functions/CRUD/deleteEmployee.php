<?php
require_once __DIR__ . '/../../config/database.php';

$conn = connectDB();
$id = '';

if (isset($_GET['deleteId'])) {
    $id = $_GET['deleteId'];
    
    $deleteAdmin = $conn->prepare('DELETE FROM admin_user WHERE employee_id = ?');
    $deleteAdmin->execute([$id]);

    $deleteEmployee = $conn->prepare('DELETE FROM employees WHERE employee_id = ?');
    $deleteEmployee->execute([$id]);
    
}
