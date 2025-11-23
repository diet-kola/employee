<?php
session_start();

require_once '../../../src/functions/CRUD/searchEmployee.php';
require_once '../../../src/functions/CRUD/deleteEmployee.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="../../_styles/admin_page.css">
    <link rel="stylesheet" href="styles.css">

</head>

<body>

<!-- Sidebar -->
<?php include '../../_reusables/sidebar.php'; ?>

<!-- Header -->
<?php include '../../_reusables/header.php'; ?>

<div id="main" class="main">
    <!-- Employee Search -->
    <form action="." method="GET" class="search-bar">  
        <input name="search" placeholder = "Search for an Employee"> </input>
        <button type="submit">Search</button>
        <button type="submit">View All</button>
    </form>   

    <!-- Add Employee -->
    <a href="./addEmployee" class="add-btn">Add a New Employee</a><br>
            
    <!-- Error Message -->
    <?php if (!empty($_SESSION['message'])): ?>
        <p>
            <?= $_SESSION['message']?>
            <?php $_SESSION['message'] = ''; ?>
        <p>
    <?php endif; ?> 
                        
    <!-- Employee Table -->
    <table>
        <?php if (!empty($results)): ?>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Hire Date</th>
                <th>Position</th>
                <th>Actions</th>
            </tr>

            <?php foreach($results as $row): ?>
                <tr>
                    <td><?= $row['first_name'] . ' ' . $row['last_name']?></td>
                    <td><?= $row['email']?></td>
                    <td><?= $row['contact_no']?></td>
                    <td><?= $row['hire_date']?></td>
                    <td><?= $row['position_name']?></td>

                    <td>
                        <div class="class-buttons">

                            <!-- Update Employee -->
                            <form action="./updateEmployee/" method="POST">
                                <input type="hidden" name="updateId" value="<?= $row['employee_id'] ?>">
                                <button type="submit">Update</button>
                            </form>

                            <!-- Delete Employee -->
                            <form action="." method="POST">
                                <input type="hidden" name="deleteId" value="<?= $row['employee_id'] ?>">
                                <button type="submit">Delete</button>
                            </form>

                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>

            <?php elseif (isset($error)): ?>
                <p> <?= $error ?> </p>

        <?php endif; ?>
    </table>
</div>

<script src="../../_javascripts/sidebar.js"></script>
</body>
</html>