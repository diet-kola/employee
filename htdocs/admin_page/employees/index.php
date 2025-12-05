<?php
session_start();

require_once '../../../src/functions/employees/search_employee.php';

$showAddModal = false;
// Handle Add Employee
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'addEmployee') {
    require_once '../../../src/functions/employees/add_employee.php';
    $showAddModal = true;
}

$showUpdModal = false;
// Handle Update Employee
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'updateEmployee') {
    require_once '../../../src/functions/employees/update_employee.php';
    $showUpdModal = true;
}

// Handle Delete Employee
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deleteId'])) {
    require_once '../../../src/functions/employees/delete_employee.php';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="../../_styles/admin_page.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="../../_styles/modals.css">

</head>

<body>

    <!-- sidebar -->
    <?php include '../../_reusables/sidebar.php'; ?>
    <!-- header -->
    <?php include '../../_reusables/header.php'; ?>

    <!-- main content -->
    <div id="main" class="main">

        <!-- employee search -->
        <form action="." method="GET" class="search-bar">  
            <input name="search" placeholder="Search for an Employee"> </input>
            

            <select name = "filter">
                <option value="" 
                    <?php if (isset($_GET['filter']) && $_GET['filter'] == "") {
                        echo "selected";
                    } else {
                        echo "";
                    }
                    ?>
                >
                    No Filter
                </option>

                <?php foreach ($positions as $row) { ?>
                    
                    <option value="<?php echo $row['position_id']?>"
                        <?php if (isset($_GET['filter']) && $_GET['filter'] == $row['position_id']) {
                                echo "selected";
                            } else {
                                echo "";
                            }
                        ?>
                    >
                        <?php echo $row['position_name']?>
                    </option>
                <?php } ?>
            </select>

            <button type="submit" name="action" value="search">Search</button>
            <button type="submit">View All</button>
        </form>   

        <!-- add employee -->
        <button class="add-btn" id="openAddEmployee">Add a New Employee</button>
                
        <!-- error message -->
         <div>
            <?php if (!empty($_SESSION['message'])) { ?>
                <p class="errors">
                    <?php 
                        echo $_SESSION['message'];
                        $_SESSION['message'] = ''; 
                    ?>
                </p>
            <?php } ?> 
        </div>
                            
        <!-- employee table -->
        <table class="table table-sortable">
            <?php if (!empty($results)) { ?>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Hire Date</th>
                        <th>Position</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody >
                    <?php foreach($results as $row) { ?>
                        <tr>
                            <td><?php echo $row['first_name'] . ' ' . $row['last_name']?></td>
                            <td><?php echo $row['email']?></td>
                            <td><?php echo $row['contact_no']?></td>
                            <td><?php echo $row['hire_date']?></td>
                            <td><?php echo $row['position_name']?></td>

                            <td>
                                <div>

                                    <!-- update employee -->
                                    <form action="." method="POST" class="update-form">
                                        <input type="hidden" name="updateId" value="<?php echo $row['employee_id'] ?>">
                                        <button type="button" class = "upd-button"
                                            data-id="<?= $row['employee_id'] ?>"
                                            data-firstn="<?= $row['first_name'] ?>"
                                            data-lastn="<?= $row['last_name'] ?>"
                                            data-email="<?= $row['email'] ?>"
                                            data-phone="<?= $row['contact_no'] ?>"
                                            data-position="<?= $row['position_id'] ?>"
                                        >
                                            Update
                                        </button>
                                    </form>

                                    <!-- delete employee -->
                                    <form action="." method="POST" class="delete-form">
                                        <input type="hidden" name="deleteId" value="<?php echo $row['employee_id'] ?>">
                                        <button type="button" class="del-button"
                                        >Delete</button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            <?php } elseif (!empty($error)) { ?>
                    <p> <?php echo $error ?> </p>
            <?php } ?>
        </table>

        <!-- Pagination -->
        <?php if ($totalPages > 1) { ?>
            <div class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                    <a href="?<?php 
                        $queryParams = $_GET;
                        $queryParams['page'] = $i;
                        echo http_build_query($queryParams);
                    ?>" class="<?php echo $i === $page ? 'active' : '' ?>"><?php echo $i ?></a>
                <?php } ?>
            </div>
        <?php } ?>
    </div>

    <!-- ADD EMPLOYEE POPUP -->
    <?php include './addEmployee/addEmpPopup.php'; ?>
    <?php include './deleteEmployee/delEmpPopup.php'; ?>
    <?php include './updateEmployee/updEmpPopup.php'; ?>


    <script src="./updateEmployee/updateEmployee.js"></script>
    <script src="./addEmployee/addEmployee.js"></script>
    <script src="./deleteEmployee/deleteEmployee.js"></script>

    <script src="../../_javascripts/sidebar.js"></script>
    <!-- <script src="../../_javascripts/preventEmptySearch.js"></script> -->

</body>

</html>
