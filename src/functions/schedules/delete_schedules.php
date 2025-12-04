<?php
require_once __DIR__ . '/../../config/database.php';
$conn = connectDB();

if (empty($_SESSION['employee_id'])) {
    header("Location: ../../login");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  $_POST['do'] === "delete") {
    $scheduleId = $_POST['id'];

    $deleteSchedule = $conn->prepare("DELETE FROM schedules WHERE schedule_id = ?");
    $deleteSchedule->execute([$scheduleId]);

    header("Location: .");
    exit;
}

