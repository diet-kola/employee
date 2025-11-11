<?php 
require_once __DIR__ . '/../config/database.php';

$conn = connectDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['view_all'])) 
{
    $results = $conn->prepare("SELECT e.employee_id, e.first_name, e.last_name, e.email, e.contact_no, e.hire_date, e.position_id, p.position_name
                                FROM employees e
                            JOIN positions p ON e.position_id = p.position_id
                                ORDER BY e.first_name
                            ");
    $results->execute();
    $results = $results->fetchAll();
    
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}