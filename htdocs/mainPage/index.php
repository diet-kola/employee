<?php
require_once '../../src/functions/CRUD/searchEmployee.php';
require_once '../../src/functions/CRUD/deleteEmployee.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="styles.css">

    <script src="../API/index.js"></script>

</head>

<header class="header">
    <div class="title-header">Hotel Employee Tracker</div>
    <div class="admin-info">
        Logged in as: <?= $_SESSION['admin_name'] ?>
        <a href="../logout.php" class="logout-btn">Logout</a>
    </div>
</header>

<body>
    <form action="." method="POST">  
        <input name="search" placeholder = "Search for an Employee"> </input>
        <button type="submit">Search</button>
    </form>
    <form action="." method="POST">
        <button type="submit">View All</button>
    </form>
    <br>    

    <a href="./addEmployee">Add a New Employee</a><br>
            
    <?php if (!empty($_SESSION['message'])): ?>
        <p>
            <?= $_SESSION['message']?>
            <?php $_SESSION['message'] = ''; ?>
        <p>
    <?php endif; ?> 
            
    <table>
        <?php if (!empty($results)): ?>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Hire Date</th>
                    <th>Position</th>
                </tr>
                <?php foreach($results as $row): ?>
                    <tr>
                        <td><?= $row['first_name'] . ' ' . $row['last_name']?></td>
                        <td><?= $row['email']?></td>
                        <td><?= $row['contact_no']?></td>
                        <td><?= $row['hire_date']?></td>
                        <td><?= $row['position_name']?></td>
                        <td>
                            <form action="./updateEmployee/" method="POST">
                                <input type="hidden" name="updateId" value="<?= $row['employee_id'] ?>">
                                <button type="submit">Update</button>
                            </form>
                        </td>
                        <td>
                            <form action="." method="POST" onsubmit="return confirmDelete('<?= $row['first_name'] . ' ' . $row['last_name'] ?>')">
                                <input type="hidden" name="deleteId" value="<?= $row['employee_id'] ?>">
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>

            <?php elseif (isset($error)): ?>
                <p>
                    <?= $error ?>
                </p>

        <?php endif; ?>
    </table>
</body>
</html>