<?php
require_once __DIR__ . "/../../config/database.php";
$conn = connectDB();

// prevents unauthorized access
if (empty($_SESSION['employee_id'])) {
    header("Location: ../../login");
    exit;
}

try {

    // get number of employees
        $employeeCount = $conn->query("SELECT COUNT(*) AS total FROM employees");
        $totalEmployees = $employeeCount->fetch();
        $totalEmployees = $totalEmployees['total'];

    // get number of positions
        $positionCount = $conn->query("SELECT COUNT(*) AS total FROM positions");
        $totalPositions = $positionCount->fetch();
        $totalPositions = $totalPositions['total'];

    // get number of employees per position
        $countEmpPerPos = $conn->query(" SELECT p.position_name, COUNT(e.employee_id) AS total
                                               FROM positions p
                                           LEFT JOIN employees e ON p.position_id = e.position_id
                                               GROUP BY p.position_id
                                        ");
        $employeesPerPosition = $countEmpPerPos->fetchAll();
} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    die("Database error occurred.");
}
?>