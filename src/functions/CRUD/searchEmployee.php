<?php
require_once __DIR__ . '/../../config/database.php';

$conn = connectDB();

$results = [];
$search = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['search'])) {
    $search = trim($_GET['search']);
    
    //check if search is not empty
    if (!empty($search)) 
    {       
        // do search
        $getEmployees = $conn->prepare ("SELECT e.employee_id, e.first_name, e.last_name, e.email, e.contact_no, e.hire_date, e.position_id, p.position_name
                                         FROM employees e 
                                         JOIN positions p ON e.position_id = p.position_id
                                         WHERE 
                                             first_name ~* ? 
                                             OR last_name ~* ? 
                                             OR (e.first_name || ' ' || e.last_name) ~* ?
                                             
                                         ORDER BY e.first_name");
        $getEmployees->execute([$search, $search, $search]);
        $results = $getEmployees->fetchAll();

        if(empty($results)) { $_SESSION['message'] = "There was no match for your search"; } // display error if there are no results
    }
    else { $_SESSION['message'] = "Please enter a name to search."; } // display error if search is empty
}
else
{
    // display all employees on start or if view all is clocked
    $getEmployees = $conn->prepare("SELECT e.employee_id, e.first_name, e.last_name, e.email, e.contact_no, e.hire_date, e.position_id, p.position_name
                               FROM employees e
                               JOIN positions p ON e.position_id = p.position_id
                               ORDER BY e.first_name");
    $getEmployees->execute();
    $results = $getEmployees->fetchAll();    
}
