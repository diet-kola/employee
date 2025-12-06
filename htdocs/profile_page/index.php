<?php
session_start();
include_once "../../src/functions/profile/profile.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php if ($user['position_id'] == 9) { ?>
        <link rel="stylesheet" href="../../_styles/admin_page.css">
    <?php } else { ?>
        <link rel="stylesheet" href="./header.css">
    <?php } ?>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>

    <?php if ($user['position_id'] == 9) { ?>
        <!-- SIDEBAR -->
        <?php include '../_reusables/sidebar.php'; ?>
        <!-- HEADER -->
        <?php include '../_reusables/header.php'; ?>
    <?php } else { ?>
        <header class="profile-header">
            Employee Profile
            <a href="../logout" class="logout-button">Logout</a>
        </header>
    <?php } ?>

    <?php if (!empty($error)) { ?>
        <p><?php echo $error;?></p>
    <?php } ?>

    <div id="main" class="main">
        <h2>Profile Information</h2>

        <div class="profile-card">
            <p>Name: <?php echo $user['first_name'] . " " . $user['last_name'] ?></p>
            <p>Email: <?php echo $user['email'] ?></p>
            <p>Contact: <?php echo $user['contact_no'] ?></p>
            <p>Position: <?php echo $user['position_name'] ?></p>
            <p>Hire Date: <?php echo $user['hire_date'] ?></p>
        </div>

    <hr>
        
    <h3>Your Schedules</h3>

    <?php if (!empty($schedules)) { ?>
        <table>
            <thead>
                <tr>  
                    <th>Date</th>
                    <th>Shift</th>
                </tr>
            </thead>
            
            <tbody>
                
                <?php foreach ($schedules as $row) { ?>
                    <tr>
                        <td><?php echo $row['work_date'] ?></td>
                         <td><?php echo $row['shift_type'] ?></td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    
        <?php } else { ?>
            <p>You have no assigned shifts.</p>
        <?php } ?>
            
    </div>

    <?php if ($user['position_id'] == 9) { ?>
        <script src="../../_javascripts/sidebar.js"></script>
    <?php } ?>

</body>
</html>