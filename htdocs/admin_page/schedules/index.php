<?php
session_start();

include_once "../../../src/functions/schedules/set_schedules.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['do']) && $_POST['do']  === 'delete') {
    include_once "../../../src/functions/schedules/delete_schedules.php";
}
?>

<!DOCTYPE html>
<html>
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="../../_styles/admin_page.css">
    <link rel="stylesheet" href="./styles.css">

</head>

<body>

<!-- SIDEBAR -->
<?php include '../../_reusables/sidebar.php'; ?>
<!-- HEADER -->
<?php include '../../_reusables/header.php'; ?>

<!-- MAIN CONTENT -->
<div class="main" id="main">
    <h3>Employee Schedules</h3>

    <div class="schedule-form">
        <h3>Add New Schedule</h3>

        <form action="." method="POST">

            <label>Employee:</label>
            <select name="employee_id">
                <option value="">Select Employee</option>
                <?php foreach ($employees as $rows) { ?>
                    <option value="<?php echo $rows['employee_id'] ?>">
                        <?php echo $rows['first_name'] . " " . $rows['last_name'] ?>
                    </option>
                <?php } ?>
            </select>

            <label>Date:</label>
            <input type="date" name="work_date">

            <label>Shift Type:</label>
            <select name="shift_type">
                <option value="">Select Shift</option>
                <option value="Day Shift">Day Shift</option>
                <option value="Night Shift">Night Shift</option>
            </select>

            <input type="hidden" name="do" value="add">
            <button type="submit">Add Schedule</button>
        </form>

        <?php if ($error) { ?>
            <p class="errors">
                <?php echo $error ?>
            </p>
        <?php } ?> 
    </div>

    <hr>

    <!-- Schedule Table -->
    <h3>Assigned Schedules</h3>

    <table class="schedule-table">
        <tr>
            <th>Employee</th>
            <th>Date</th>
            <th>Shift Type</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($schedules as $rows) { ?>
            <tr>
                <td><?= $rows['first_name'] . " " . $rows['last_name'] ?></td>
                <td><?= $rows['work_date'] ?></td>
                <td><?= $rows['shift_type'] ?></td>

                <td>
                    <form action="." method="POST">
                        <input type="hidden" name="do" value="delete">
                        <input type="hidden" name="id" value="<?= $rows['schedule_id'] ?>">
                        <button type="button" class="del-btn">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php include "./deleteSchedule/delSchedPopup.php"?>

<script src="./deleteSchedule/deleteSchedule.js"></script>
<script src="../../_javascripts/sidebar.js"></script>

</body>
</html>