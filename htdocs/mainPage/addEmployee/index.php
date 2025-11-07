<?php
require_once '../../../src/functions/CRUD/addEmployee.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Add a New Employee</h1>

    <fieldset>
        <form action="." method="POST">

            <?php if ($error): ?>
                <div>
                    <p> <?= $error?> </p>
                </div>
            <?php endif; ?>

            <label>First Name:</label>
            <input type="text" name="first_name"><br>

            <label>Last Name:</label>
            <input type="text" name="last_name"><br>

            <label>Email:</label>
            <input type="email" name="email"><br>

            <label>Phone Number:</label>
            <input type="text" name="phoneNum"><br>

            <div class="select-container">
                <label>Position:</label>
                    <select name="position_id">
                        <option value="">Position</option>
                        <option value="1">Manager</option>
                        <option value="2">Chef</option>
                        <option value="3">Server</option>
                        <option value="4">Receptionist</option>
                        <option value="5">Bellhop</option>
                        <option value="6">Room Attendant</option> 
                        <option value="7">Room Server</option>   
                        <option value="8">Repairman</option>  
                    </select>
            </div>  

            <input type="submit" value="Add Employee">
        </form>
                
        <?php if ($name): ?>
            <div>
                <p> <?= $name?> </p>
            </div>
        <?php endif; ?>
    </fieldset>
</body>
</html>