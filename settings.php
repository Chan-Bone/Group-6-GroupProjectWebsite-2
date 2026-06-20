<?php
    $host = "localhost";
    $user = "root";
    $pwd = "";
    // You will update this database name later when you create your MySQL database
    $sql_db = "your_database_name"; 
    
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
?>