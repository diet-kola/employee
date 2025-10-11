<?php
    function connectDB()
    {
        $username = "postgres";
        $password = "harvey";
        $hostname = "localhost";
        $port = 5432;
        $dbname = "employee_tracker";

        try {
            $dsn = "pgsql:host=$hostname;port=$port;dbname=$dbname";
            $pdo = new PDO($dsn, $username, $password);
            $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;
            
        } catch (PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
            exit(500);
        }
    }