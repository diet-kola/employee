<?php
require_once __DIR__ . '/../../config/database.php';
session_start();
$conn = connectDB();

$results = [];
$search = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $checkSearch = $_POST['search'];
    if (isset($checkSearch)) {
        $search = trim($checkSearch);   
        
        $results = $conn->prepare
        ("
            SELECT
                e.employee_id, e.first_name, e.last_name, e.email, e.contact_no, e.hire_date, e.position_id, p.position_name
            FROM employees e 
            JOIN positions p ON e.position_id = p.position_id
            WHERE first_name ~* ?
        ");

        $results->execute([$search]);
        $results = $results->fetchAll();
    }
}