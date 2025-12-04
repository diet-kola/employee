<?php
require_once __DIR__ . '/../../config/database.php';
$conn = connectDB();

$results = [];
$search = '';
$limit = 10; // number of employees per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$totalEmployees = 0;
$totalPages = 1;

$query = "";
$params = [];

if (empty($_SESSION['employee_id'])) {
        header("Location: ../../login");
        exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Handle search
    if (isset($_GET['action']) && $_GET['action'] === 'search' && isset($_GET['search'])) {
        $search = trim($_GET['search']);
        $filter = trim($_GET['filter']);
    }

    if (!empty($search)) {
        switch($filter) {

            case 'name':
                break;
            
            case 'email':
                break;

            case 'contact':
                break;

            case 'position';
                break;

            default:
                break;

        }
    }


    $countEmployees = $conn->prepare(" SELECT COUNT(*) 
                                          FROM employees e 
                                      JOIN positions p ON e.position_id = p.position_id
                                          $where");
    $countEmployees->execute($params);
    $totalEmployees = $countEmployees->fetchColumn();

    $totalPages = ceil(max($totalEmployees, 1) / $limit);

    $getEmployeesQuery = "SELECT e.employee_id, e.first_name, e.last_name, e.email, 
                                 e.contact_no, e.hire_date, e.position_id, p.position_name
                          FROM employees e
                          JOIN positions p ON e.position_id = p.position_id
                          $where
                          ORDER BY e.first_name
                          LIMIT ? OFFSET ?";

    $fetchParams = $params;
    $fetchParams[] = $limit;
    $fetchParams[] = $offset;

    $getEmployees = $conn->prepare(" SELECT e.employee_id, e.first_name, e.last_name, e.email, 
                                         e.contact_no, e.hire_date, e.position_id, p.position_name
                                     FROM employees e
                                         JOIN positions p ON e.position_id = p.position_id
                                     $where
                                     ORDER BY e.first_name
                                         LIMIT ? OFFSET ?");
    $getEmployees->execute($fetchParams);
    $results = $getEmployees->fetchAll();

    if (!empty($search) && empty($results)) {
        $_SESSION['message'] = "There was no match for your search";
    }
    
}

