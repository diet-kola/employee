<?php
require_once __DIR__ . '/../../config/database.php';

$conn = connectDB();
$id = '';

if (isset($_GET['deleteId'])) {
    die;
    $id = $_GET['deleteId'];
    
    $delete = $conn->prepare('DELETE FROM employees WHERE employee_id = ?');
    $delete->execute([$id]);
         
    header ('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
