<?php
require_once __DIR__ . '/../../config/database.php';

session_start();
$conn = connectDB();

$results = [];
$search = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $search = trim($_POST['search']);
    if (!empty($search)) {   
        
        $results = $conn->prepare
        ("
            SELECT
                e.employee_id, e.first_name, e.last_name, e.email, e.contact_no, e.hire_date, e.position_id, p.position_name
            FROM employees e 
            JOIN 
                positions p ON e.position_id = p.position_id
            WHERE 
                first_name ~* ? OR
                last_name ~* ?
        ");

        $results->execute([$search, $search]);
        $results = $results->fetchAll();
    }
}