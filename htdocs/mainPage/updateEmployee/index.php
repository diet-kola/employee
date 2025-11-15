<?php 
require_once '../../../src/functions/CRUD/updateEmployee.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Employee</title>
</head>
<body>
    <h1>Update Employee</h1>

    <?php if (!empty($error)): ?>
        <p>
            <?= $error ?>
        </p>
    <?php endif; ?>

    <form action="" method="POST">
        <input type="hidden" name="updateId" value="<?= $employee['employee_id'] ?>">

        <label>First Name:</label>
        <input type="text" name="first_name" value="<?= $employee['first_name'] ?>"><br>

        <label>Last Name:</label>
        <input type="text" name="last_name" value="<?= $employee['last_name'] ?>"><br>

        <label>Email:</label>
        <input type="email" name="email" value="<?= $employee['email'] ?>"><br>

        <label>Phone Number:</label>
        <input type="text" name="contact_no" value="<?= $employee['contact_no'] ?>"><br>


        <label>Position:</label>
        <select name="position_id">
            <?php foreach ($positions as $position): ?>
                <option value="<?= $position['position_id'] ?>">
                    <?= $position['position_name'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit">Update Employee</button>
    </form>

    <a href="..">Back to Main Page</a>
</body>
</html>
