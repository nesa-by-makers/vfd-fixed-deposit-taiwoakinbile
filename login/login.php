<?php

    $server = "localhost";
    $username ="root";
    $password = "Archetype";
    $database = "vfd_fd_form";

    $connection = new mysqli($server, $username, $password, $database);

    if($connection->connect_error) {
        die("Database connection failed: " . $connection->connect_error );
    }

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT username, password from admin where id=1;";

    $result = $connection->query($query);


// puts values for multiple coulmn in an"aarray" using fetch_assoc
    if($result->num_rows > 0){
        while ($row =  $result->fetch_assoc()){
      $userlogin = $row["username"];
      $passlogin = $row["password"];
        }
    }

    // compares the form input and the query result
    if ($username == $userlogin && $password == $passlogin){
        echo "username and password correct";
    }
    else {
        echo "username and password Incorrect";
    }
    
    $connection-> close();
    
?>