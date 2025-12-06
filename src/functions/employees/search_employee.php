<?php
require_once __DIR__ . '/../../config/database.php';
$conn = connectDB();

$results = [];
$search = '';
$limit = 7; // number of employees per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;
$totalEmployees = 0;
$totalPages = 1;

$whereQuery = "";
$conds = []; //conditions

if (empty($_SESSION['employee_id'])) {
        header("Location: ../../login");
        exit;
}

try {
    $getPositions = $conn->prepare("SELECT position_id, position_name FROM positions ORDER BY position_name");
    $getPositions->execute();
    $positions = $getPositions->fetchAll();
} catch (PDOException $e) {
    $error = "Failed to get positions: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' || $_SERVER['REQUEST_METHOD'] === 'POST') {

    // Handle search
    if (isset($_GET['action']) && $_GET['action'] === 'search' && isset($_GET['search'])) {
        $search = trim($_GET['search']);
        $filter = trim($_GET['filter']); // get position_id for search filtering

        // builds the where query
        if (!empty($search)) {
            $whereQuery = "(e.first_name ~* ? OR e.last_name ~* ? OR (e.first_name || ' ' || e.last_name) ~* ?)";
            $conds[] = $search;
            $conds[] = $search;
            $conds[] = $search;
        }
     
        if (!empty($filter)) {
            if (!empty($whereQuery)) {
                $whereQuery .= " AND ";
            }
            $whereQuery .= "e.position_id = ?";
            $conds[] = $filter;
        }

        if (!empty($whereQuery)) {
            $whereQuery = "WHERE " . $whereQuery;
        }
    }

    try {
        // get number of employees
        $countEmployees = $conn->prepare("SELECT COUNT(*) FROM employees e JOIN positions p ON e.position_id = p.position_id $whereQuery");
        $countEmployees->execute($conds);
        $totalEmployees = $countEmployees->fetchColumn();
        $totalPages = ceil(max($totalEmployees, 1) / $limit); // gets total pages

        // query that gets employees.
        // adds the where query that we built for search and filteering
        $getEmployees = $conn->prepare(" SELECT e.employee_id, e.first_name, e.last_name, e.email, 
                                            e.contact_no, e.hire_date, e.position_id, e.password, p.position_name
                                        FROM employees e
                                            JOIN positions p ON e.position_id = p.position_id
                                        $whereQuery
                                        ORDER BY e.first_name
                                            LIMIT $limit OFFSET $offset");
        $getEmployees->execute($conds);
        $results = $getEmployees->fetchAll();

        //error handling
        if (!empty($search) && empty($results)) {
            $error = "There was no match for your search";
        }
    } catch (PDOException $e) {
        $error = "Error fetching employees: " . $e->getMessage();
    }
}

