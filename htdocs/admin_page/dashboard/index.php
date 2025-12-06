<?php
session_start();
require_once "../../../src/functions/dashboard/employee_stats.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../_styles/admin_page.css">
    <link rel="stylesheet" href="./styles.css">

</head>

<body>

    <!-- SIDEBAR -->
    <?php include '../../_reusables/sidebar.php'; ?>
    <!-- HEADER -->
    <?php include '../../_reusables/header.php'; ?>

    <!-- MAIN CONTENT -->
    <div id="main" class="main">
        <h2>Dashboard</h2>

        <!-- show employee and position stats -->
        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>Total Employees</h3>
                <p><?php echo $totalEmployees ?></p>
            </div>

            <div class="stat-card">
                <h3>Total Positions</h3>
                <p><?php echo $totalPositions ?></p>
            </div>
        </div>

        <hr>
        <!-- employees per position -->
        <h3>Employees per Position</h3>
        <table>
            <tr>
                <th>Position</th>
                <th>Employee Count</th>
            </tr>

            <?php foreach ($employeesPerPosition as $row) { ?>
            <tr>
                <td><?php echo $row['position_name'] ?></td>
                <td><?php echo $row['total'] ?></td>
            </tr>
            <?php } ?>

        </table>
    </div>
</body>

<script src="../../_javascripts/sidebar.js"></script>
</html>