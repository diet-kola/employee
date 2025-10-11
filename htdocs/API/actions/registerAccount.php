<?php

    require '../../src/config/database.php';

    $data = file_get_contents("php://input");
    $json_data = json_decode($data, true);

    $username = $json_data["username"];
    $email = $json_data["email"];
    $password = $json_data["password"];

    $connect = connectDB();