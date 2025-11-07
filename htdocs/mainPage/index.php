<?php
require_once '../../src/functions/CRUD/searchEmployee.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hotel Employee Tracker</h1>

    <form action="." method="POST">  
        <input name="search" placeholder = "Search for an Employee"> </input>
        <button type="submit">Search</button>
    </form>
    <br>    

    <a href="./addEmployee">Add a New Employee</a><br>

    <table>
        <?php if ($search): ?>
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
                        <form action="." action="GET">
                            <input type="hidden" name="update" value="<?= $row['employee_id'] ?>">
                            <button type="submit">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php  ?>

       
    </table>
</body>
</html>