<?php
require_once __DIR__ . '/../../config/database.php';
$conn = connectDB();
$error = "";

// DISPLAY SCHEDULES
if (empty($_SESSION['employee_id'])) {
    header("Location: ../../login");
    exit;
}

// get employees
$getEmployees = $conn->prepare("SELECT employee_id, first_name, last_name FROM employees ORDER BY first_name");
$getEmployees->execute();
$employees = $getEmployees->fetchAll();

// get existing schedules
$getSchedules = $conn->prepare("
    SELECT s.schedule_id, s.work_date, s.shift_type,
           e.first_name, e.last_name
    FROM schedules s
    JOIN employees e ON s.employee_id = e.employee_id
    ORDER BY s.work_date
");
$getSchedules->execute();
$schedules = $getSchedules->fetchAll();

// set schedule

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  $_POST['do'] === "add") {

    $employeeId = $_POST['employee_id'];
    $workDate = $_POST['work_date'];
    $shiftType = $_POST['shift_type'];

    if (empty($employeeId)) { $error = "Please select an employee."; }
    elseif (date("Y-m-d") > $workDate) { $error = "Please enter a valid date."; }
    elseif (empty($workDate)) { $error = "Please enter when the date that the employee will be working."; }
    elseif (empty($shiftType)) { $error = "Please enter when the employee will be working."; }
    else if ($employeeId && $workDate && $shiftType) {
        $setSchedule = $conn->prepare("
            INSERT INTO schedules (employee_id, work_date, shift_type)
            VALUES (?, ?, ?)
        ");
        $setSchedule->execute([$employeeId, $workDate, $shiftType]);
        header("Location: .");
        exit;
    }
}