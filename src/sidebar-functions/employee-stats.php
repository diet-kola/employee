<?php

require_once __DIR__ . "/../config/database.php";
$conn = connectDB();

// Total Employee Count
    $employeeCount = $conn->prepare("SELECT COUNT(*) AS total FROM employees");
    $employeeCount->execute();
    $totalEmployees = $employeeCount->fetch();
    $totalEmployees = $totalEmployees['total'];

// Total Positions
    $positionCount = $conn->prepare("SELECT COUNT(*) AS total FROM positions");
    $positionCount->execute();
    $totalPositions = $positionCount->fetch();
    $totalPositions = $totalPositions['total'];

// No. of Employees per Positions
    $countEmpPerPos = $conn->prepare(" SELECT p.position_name, COUNT(e.employee_id) AS total
                                                    FROM positions p
                                                  LEFT JOIN employees e ON p.position_id = e.position_id
                                                    GROUP BY p.position_id
                                                ");
    $countEmpPerPos->execute();
    $employeesPerPosition = $countEmpPerPos->fetchAll();

?>