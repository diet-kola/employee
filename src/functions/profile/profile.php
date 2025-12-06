<?php
include_once __DIR__ . "/../../config/database.php";
$conn = connectDB();

if (empty($_SESSION['employee_id'])) {
    header("Location: ../../login");
    exit;
}

try {

    // Get all information of user
    $userId = $_SESSION['employee_id'];

    $getUser = $conn->prepare(" SELECT e.employee_id, e.first_name, e.last_name, e.email, e.contact_no, e.hire_date, p.position_name, p.position_id
                                    FROM employees e
                                JOIN positions p ON e.position_id = p.position_id
                                    WHERE e.employee_id = ?");
    $getUser->execute([$userId]);
    $user = $getUser->fetch();

    $getSchedule = $conn->prepare(" SELECT work_date, shift_type
                                        FROM schedules
                                    WHERE employee_id = ?
                                        ORDER BY work_date DESC");
    $getSchedule->execute([$userId]);
    $schedules = $getSchedule->fetchAll();
} catch (PDOException $e) {
    $error = "An error occured while loading your information";
}
