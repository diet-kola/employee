<?php
session_start();
require_once "../../../src/sidebar-functions/employee-stats.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../_styles/admin_page.css">
</head>

<body>
    <!-- Sidebar -->
    <?php include '../../_reusables/sidebar.php'; ?>

    <!-- Header -->
    <?php include '../../_reusables/header.php'; ?>

    
<div id="main" class="main">

    <h2>Dashboard</h2>

    <!-- Stats -->
    <div class="dashboard-stats">
        <div class="stat-card">
            <h3>Total Employees</h3>
            <p><?= $totalEmployees ?></p>
        </div>

        <div class="stat-card">
            <h3>Total Positions</h3>
            <p><?= $totalPositions ?></p>
        </div>
    </div>

    <!-- Employees per Position -->
    <h3>Employees per Position</h3>
    <table>
        <tr>
            <th>Position</th>
            <th>Employee Count</th>
        </tr>

        <?php foreach ($employeesPerPosition as $row): ?>
        <tr>
            <td><?= $row['position_name'] ?></td>
            <td><?= $row['total'] ?></td>
        </tr>
        <?php endforeach; ?>

    </table>
</div>
</body>

<script src="../../_javascripts/sidebar.js"></script>
</html>